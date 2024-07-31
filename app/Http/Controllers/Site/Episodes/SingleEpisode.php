<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Enums\EpisodeQuizType;
use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Choice;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserEpisodeQuizResult;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SingleEpisode extends BaseComponent
{
    use AuthorizesRequests;
    public  $course_data , $chapter_data , $episode_data;

    public $chapters , $episodes = [];

    public  $show_homework_form = false ;

    private $timer;

    public $user;

    public $api_bucket , $episode_id , $local_video;

    public $recaptcha;

    public $quiz;
    public array $answers = [];
    public $quizStarted = false;

    public $result;

    public $lastPoint;


    public $questions = [];

    public $optionalQuizAtTime = [] , $requiredQuizAtTime = [];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
    }

    public function mount($course , $chapter , $episode)
    {
        $this->user = auth()->user();
        $this->course_data = $this->courseRepository->get('slug',$course,true);
        $this->loadData($chapter , $episode);
        if (
            !$this->episode_data->free && $this->course_data->price > 0 && ( (\auth()->check() && !$this->user->hasCourse($this->course_data->id)) || !\auth()->check()) )
            abort(404);

        $title = $this->course_data->title.' | '.$this->episode_data->title;
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($this->course_data->seo_description);
        SEOMeta::addKeyword($this->course_data->seo_keywords);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($this->course_data->seo_description);
        TwitterCard::setTitle($title);
        TwitterCard::setDescription($this->course_data->seo_description);
        JsonLd::setTitle($title);
        JsonLd::setDescription($this->course_data->seo_description);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));

       $this->updateRequiredQuiz();

        if (Auth::check() && $this->episode_data->can_homework)
            $this->show_homework_form = $this->user->hasCourse($this->course_data->id);


    }

    public function loadData($chapter , $episode)
    {
        $this->chapter_data = $this->course_data->chapters->where('slug',$chapter)->first();
        $this->episode_data = $this->chapter_data->episodes->where('id',$episode)->first();
    }

    public function loadEpisode($chapter , $episode)
    {
        if (is_numeric($chapter)) {
            $this->chapter_data = $this->course_data->chapters->where('id',$chapter)->first();
        }
        $this->episode_data = $this->chapter_data->episodes->where('id',$episode)->first();

        if (Auth::check() && $this->episode_data->can_homework)
            $this->show_homework_form = $this->user->hasCourse($this->course_data->id);
    }

    public function render()
    {
        return view('site.episodes.single-episode')->extends('site.layouts.site.episode');
    }


    public function resetQuiz(): void
    {
        $this->reset(['quiz','quizStarted','answers','lastPoint','questions']);
    }

    public function checkFinalQuiz()
    {
        $this->resetQuiz();
        $this->quiz = $this->episode_data->quizzes()->where('type',EpisodeQuizType::END)->first();
        if ($this->quiz) {
            if (
                UserEpisodeQuizResult::query()->where('episode_quiz_id' , $this->quiz->id)
                    ->where('user_id',\auth()->id())
                    ->where('passed','!=',null)->exists()
            ) {
                return;
            }
            $this->emitShowModal('quiz');
        }
    }

    public function startQuiz(): void
    {
        if ($this->quiz && ! $this->quizStarted) {
            if (
                UserEpisodeQuizResult::query()->where('episode_quiz_id' , $this->quiz->id)
                    ->where('user_id',\auth()->id())
                ->where('passed','!=',null)->whereHas('quiz' , function ($q){
                    $q->whereIn('type',[EpisodeQuizType::END]);
                })->exists()
            ) {
                return;
            }
            $this->result = UserEpisodeQuizResult::query()->create([
                'user_id' => \auth()->id(),
                'episode_quiz_id' => $this->quiz->id,
            ] );
            $this->questions = $this->quiz->questions()->take($this->quiz->questions_count ?? 1)->inRandomOrder(mt_rand(1,10))->get();
            $this->quizStarted = true;
            $this->timer = now()->addSeconds($this->quiz->timer)->format("Y-m-d H:i:s");
            $this->emit('timer',['data' => $this->timer ?? '']);
        }
    }

    public function finishQuiz(): void
    {
        if ($this->quiz && $this->quizStarted && $this->checkTimer()) {
            $questions = $this->quiz->questions()->with('choices')->get();
            $score = 0;
            $answers = [];

            foreach ($questions as $question) {
                if (
                    in_array($question->id , collect($this->questions)->pluck('id')->toArray())
                ) {
                    $answers[$question->id] = $question;
                    if (
                        $question->true_choice->id == ($this->answers[$question->id] ?? 0)
                    ) {
                        $score += $question->score;
                        $answers[$question->id]['status'] = true;
                        UserAnswer::query()->create([
                            'user_id' => \auth()->id(),
                            'choice_id' => $this->answers[$question->id],
                            'course_id' => $this->course_data->id,
                            'choice_value' => Choice::query()->find($this->answers[$question->id])?->id,
                            'true_choice_value' => $question->true_choice->title,
                            'score_received' => $question->score,
                            'question_score' => $question->score,
                            'question_text' => $question->text,
                            'question_id' => $question->id,
                            'status' => true
                        ]);
                    } else {
                        $answers[$question->id]['status'] = false;

                        UserAnswer::query()->create([
                            'user_id' => \auth()->id(),
                            'choice_id' => $this->answers[$question->id] ?? null,
                            'course_id' => $this->course_data->id,
                            'true_choice_value' => $question->true_choice->title,
                            'score_received' => $question->score,
                            'question_score' => $question->score,
                            'question_text' => $question->text,
                            'question_id' => $question->id,
                            'status' => false
                        ]);
                    }
                }
            }
            $total = collect($this->questions)->sum('score');

            if ($total == $score && $this->quiz->coins > 0) {
                auth()->user()->deposit($this->quiz->coins, ['description' => 'جایزه آزمون', 'from_admin'=> true]);
            }

            UserEpisodeQuizResult::query()->where('user_id',\auth()->id())->where('id',$this->result->id)
                ->where('passed',null)
                ->update([
                    'score' => (int)$score,
                    'answers' => $answers,
                    'passed' => $total == $score,
                    'total_score' => $total
            ]);
            $this->updateRequiredQuiz();
            $this->result->refresh();

            if ($this->quiz->type == EpisodeQuizType::REQUIRED_TIME && ! $this->result->passed && $this->lastPoint) {
                $this->emit('backToLastPoint', [
                    'at' => $this->lastPoint
                ]);
            }

            $this->resetQuiz();
            $this->emitHideModal('quiz');
            $this->emitNotify('آزمون شما با موفقیت ثبت شد');
            $this->emitShowModal('result');
        }
    }

    public function updateRequiredQuiz()
    {
        $this->optionalQuizAtTime =  $this->episode_data->quizzes()->where('type',EpisodeQuizType::OPTIONAL_TIME)->get()->map(function ($item){
            return [
                'id' => $item->id,
                'at' => Carbon::createFromTimestamp(Carbon::make($item->at)->timestamp)->secondsSinceMidnight(),
                'done' => UserEpisodeQuizResult::query()->where('user_id',\auth()->id())->where('passed',true)->where('episode_quiz_id',$item->id)->exists()
            ];
        });
        $this->requiredQuizAtTime =  $this->episode_data->quizzes()->where('type',EpisodeQuizType::REQUIRED_TIME)->get()->map(function ($item){
            return [
                'id' => $item->id,
                'at' => Carbon::createFromTimestamp(Carbon::make($item->at)->timestamp)->secondsSinceMidnight(),
                'done' => UserEpisodeQuizResult::query()->where('user_id',\auth()->id())->where('passed',true)->where('episode_quiz_id',$item->id)->exists()
            ];
        })->sortBy('at');

        $this->emit('updateRequiredQuiz' , $this->requiredQuizAtTime);
        $this->emit('updateOptionalQuiz' , $this->optionalQuizAtTime);
    }

    public function requiredQuiz($data): void
    {
        $this->resetQuiz();
        $this->quiz = $this->episode_data->quizzes()->find($data['id']);

        if ($this->quiz && UserEpisodeQuizResult::query()->where('user_id',\auth()->id())->where('passed',true)->where('episode_quiz_id' , $data['id'])->doesntExist()) {
            if (! empty($data['lastPoint'])) {
                $this->lastPoint = $data['lastPoint'];
            }

            $this->emitShowModal('quiz');
        }

    }

    private function checkTimer(): bool
    {
        $interval = Carbon::make(now())->diff(Carbon::make($this->timer));
        return ((int)$interval->format("%r") >= "");
    }
}
