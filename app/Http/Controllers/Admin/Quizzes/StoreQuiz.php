<?php

namespace App\Http\Controllers\Admin\Quizzes;

use App\Enums\CategoryEnum;
use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;

class StoreQuiz extends BaseComponent
{
    public object $quiz;
    public $header ,  $name  , $image , $descriptions , $time , $certificate , $accept_type , $min_score , $rand = true, $show_choices_type,
        $enter_count , $selected_questions , $category , $questions = [] , $selected_questions_id = [] , $total_score = 0 ,
        $selected_questions_list = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->certificateRepository = app(CertificateRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_quizzes');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->quiz = $this->quizRepository->find($id);
            $this->name = $this->quiz->name;
            $this->header = $this->quiz->name;
            $this->image = $this->quiz->image;
            $this->descriptions = $this->quiz->descriptions;
            $this->time = $this->quiz->time;
            $this->certificate = $this->quiz->certificate_id;
            $this->accept_type = $this->quiz->accept_type;
            $this->min_score = $this->quiz->min_score;
            $this->rand = $this->quiz->rand;
            $this->enter_count = $this->quiz->enter_count;
            $this->show_choices_type = $this->quiz->show_choices_type;
            $this->selected_questions = $this->quiz->questions->pluck('id','id')->toArray();
            $this->updatedSelectedQuestions();
            $this->total_score = $this->quiz->questions->sum('score');
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'ازمون جدید';
            $this->show_choices_type = QuizEnum::SHOW_SIDE_BY_SIDE;
        } else abort(404);
        $this->data['type'] = QuizEnum::getType();
        $this->data['question_categories'] = $this->categoryRepository->getAll(CategoryEnum::QUESTION)->pluck('title','id');
        $this->data['certificate'] = $this->certificateRepository->getAll()->pluck('name','id');
        $this->data['show_choices_type'] = QuizEnum::getViews();

    }

    public function deleteItem()
    {
        $this->authorizing('delete_quizzes');
        $this->quizRepository->delete($this->quiz);
        return redirect()->route('admin.quiz');
    }

    public function render()
    {
        return view('admin.quizzes.store-quiz')->extends('admin.layouts.admin');
    }

    public function store(QuizRepositoryInterface $quizRepository)
    {
        $this->authorizing('edit_quizzes');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->quiz);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->quizRepository->newQuizObject());
            $this->reset(['name','show_choices_type','image','descriptions','time','certificate','accept_type','min_score','rand','enter_count','selected_questions']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate([
            'name' => ['required','string','max:50'],
            'image' => ['required','string','max:255'],
            'descriptions' => ['required','string','max:38000'],
            'time' => ['required','integer','between:1,99999999999999999'],
            'certificate' => ['nullable','exists:certificates,id'],
            'accept_type' => ['required','in:'.implode(',',array_keys(QuizEnum::getType()))],
            'min_score' => ['required','numeric','between:0,99999999999999.9999999'],
            'rand' => ['boolean'],
            'enter_count' => ['required','integer','between:1,99999999999999999'],
            'selected_questions' => ['array','min:1'],
            'show_choices_type' => ['required','in:'.implode(',',array_keys(QuizEnum::getViews()))]
        ] , [], [
            'name' => 'نام ازمون',
            'image' => 'تصویر ازمون',
            'descriptions' => 'توضیحات',
            'time' => 'زمان',
            'certificate' => 'گواهینامه',
            'accept_type' => 'روش محسابه نمره',
            'min_score' => 'حداقل نمره قبولی',
            'rand' => 'نمایش رندم سوالات',
            'enter_count' => 'تعداد دفعات مجاز ورود به ازمون',
            'selected_questions' => 'سوالات',
            'show_choices_type' => 'نمایش گزینه ها'
        ]);

        $model->name = $this->name;
        $model->image = $this->image;
        $model->descriptions = $this->descriptions;
        $model->time = $this->time;
        $model->certificate_id = $this->certificate;
        $model->accept_type = $this->accept_type;
        $model->min_score = $this->min_score;
        $model->rand = $this->rand;
        $model->enter_count = $this->enter_count;
        $model->show_choices_type = $this->show_choices_type;
        $model = $this->quizRepository->save($model);
        if ($this->mode == self::CREATE_MODE)
            $this->quizRepository->attachQuestions($model,$this->selected_questions_id);
        elseif ($this->mode == self::UPDATE_MODE)
            $this->quizRepository->syncQuestions($model,$this->selected_questions_id);

        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function updatedCategory()
    {
        $questions = [];
        if (isset($this->category) && !empty($this->category))
            $questions =  app(CategoryRepositoryInterface::class)->find($this->category)->questions;

        $this->questions = $questions;
    }

    public function updatedSelectedQuestions()
    {
        $QuestionRepository = app(QuestionRepositoryInterface::class);
        $total_score = 0;

        $this->selected_questions_id = array_filter($this->selected_questions);

        $this->selected_questions_list = $QuestionRepository->findMany($this->selected_questions_id);

        foreach ($this->questions as $item){
            if (in_array($item->id,$this->selected_questions_id))
                $total_score = $total_score + $item->score;
        }

        $this->total_score = $total_score;
    }
}
