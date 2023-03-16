<?php


namespace App\Repositories\Classes;

use App\Enums\JobEnum;
use App\Enums\QuizEnum;
use App\Jobs\ExamJob;
use App\Models\Quiz;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class QuizRepository implements QuizRepositoryInterface
{
    public function getAllAdmin($search, $per_page)
    {
        return Quiz::latest('id')->search($search)->paginate($per_page);
    }

    public function find($id)
    {
        return Quiz::findOrFail($id);
    }

    public function delete(Quiz $quiz)
    {
        return $quiz->delete();
    }

    public function destroy($id)
    {
        return Quiz::destroy($id);
    }

    public function save(Quiz $quiz)
    {
       $quiz->save();
       return $quiz;
    }

    public function newQuizObject()
    {
        return new Quiz();
    }

    public function syncQuestions(Quiz $quiz, array $questions)
    {
        $quiz->questions()->sync($questions);
    }

    public function attachQuestions(Quiz $quiz, array $questions)
    {
        $quiz->questions()->attach($questions);
    }

    public function getAll()
    {
        return Quiz::all();
    }

    public function startQuiz(Quiz $quiz, int $seed = 0)
    {
        return $quiz->questions()->inRandomOrder($seed)->paginate(1);
    }

    public function count()
    {
        return Quiz::count();
    }

    public function process( $transcript , $force_process = false , $needs_teacher = false)
    {
        if (app(SettingRepositoryInterface::class)->getRow('exam_should_be_queueable') && ! $force_process) {
            $transcript->update(['result' => QuizEnum::ON_QUEUE]);
            ExamJob::dispatch($transcript ,$needs_teacher)->onQueue(JobEnum::EXAM);
        } else {
            // exam will process by system
            ExamJob::dispatchSync($transcript,$needs_teacher);
        }
    }
}
