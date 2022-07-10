<?php

namespace App\Http\Controllers\Admin\Questions;

use App\Enums\CategoryEnum;
use App\Enums\QuestionEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ChoiceRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;

class StoreQuestion extends BaseComponent
{
    public $header , $name , $text , $score , $source , $difficulty  , $category ,  $choices = [];
    public object $question;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->questionRepository = app(QuestionRepositoryInterface::class);
        $this->choiceRepository = app(ChoiceRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_questions');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->question = $this->questionRepository->find($id);
            $this->name = $this->question->name;
            $this->header = $this->name;
            $this->text = $this->question->text;
            $this->score = $this->question->score;
            $this->source = $this->question->source;
            $this->difficulty = $this->question->difficulty;
            $this->category = $this->question->category_id;
            $this->choices = $this->question->choices->toArray() ?? [];
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'طراحی سوال جدید';
        } else abort(404);

        $this->data['categories'] = $this->categoryRepository->getAll(CategoryEnum::QUESTION)->pluck('title','id');
        $this->data['difficulty'] = QuestionEnum::getDifficulty();
    }

    public function store()
    {
        $this->authorizing('edit_questions');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->question);
        elseif ($this->mode == self::CREATE_MODE)
            $this->saveInDataBase($this->questionRepository->newQuestionObject());
    }

    public function saveInDataBase($model)
    {
        $this->validate([
            'name' => ['required','string','max:30'],
            'text' => ['required','string','max:25000'],
            'score' => ['required','numeric','between:0,99999999.999'],
            'source' => ['nullable','string','max:60'],
            'difficulty' => ['required','in:'.implode(',',array_keys(QuestionEnum::getDifficulty()))],
            'category' => ['required','exists:categories,id'],
            'choices' => ['array','min:1'],
            'choices.*.title' => ['required','string','max:75'],
            'choices.*.is_true' => ['boolean'],
            'choices.*.score' => ['required','integer','between:-100,100'],
        ],[],[
            'name' => 'نام سوال',
            'text' => 'متن سوال',
            'score' => 'نمره سوال',
            'source' => 'منبع سوال',
            'difficulty' => 'سطح سوال',
            'category' => 'دسته سوال',
            'choices' => 'گزینه ها',
            'choices.*.title' => 'عنوان گزینه',
            'choices.*.is_true' => 'صحت گزینه',
            'choices.*.score' => 'درصد نمره',
        ]);
        $check_choice = @array_count_values(array_column($this->choices,'is_true'))[1];

        if ($check_choice > 1)
            return $this->addError('choices.*.is_true','گزینه صحیح نمی تواند بیشتر از یک مورد باشد');
        elseif ($check_choice < 1)
            return $this->addError('choices.*.is_true','انتخاب گزینه صحیح اجباری می باشد');

        $model->name = $this->name;
        $model->text = $this->text;
        $model->score = $this->score;
        $model->source = $this->source;
        $model->difficulty = $this->difficulty;
        $model->category_id = $this->category;
        $question = $this->questionRepository->save($model);
        foreach ($this->choices as $item) {
            $choice =  $item['id'] <> 0 ? $this->choiceRepository->find($item['id']) : $this->choiceRepository->newChoiceObject();
            $choice->title = $item['title'];
            $choice->question_id = $question->id;
            $choice->is_true = $item['is_true'] ?? false;
            $choice->score = (isset($item['is_true']) && $item['is_true']) ? 100 : $item['score'];
            $this->choiceRepository->save($choice);
        }
        if ($this->mode == self::CREATE_MODE)
            $this->reset(['name','choices','text','score','source','difficulty','category']);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function addChoice()
    {
        $this->choices[] = ['id' => 0];
    }

    public function deleteChoice($key)
    {
        $choice = $this->choices[$key];
        if ($choice['id'] <> 0)
            $this->choiceRepository->destroy($choice['id']);
        unset($this->choices[$key]);

        return $this->emitNotify('گزینه با موفقیت حذف شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_questions');
        $this->questionRepository->delete($this->question);
        return redirect()->route('admin.question');
    }

//    public function updatedChoices($value,$name)
//    {
//        $this->choices = collect($this->choices)->map(function ($item , $key) use ($name)
//        {
//            $item['is_true'] = explode('.',$name)[0] == $key;
//            return $item;
//        })->toArray();
//    }

    public function render()
    {
        return view('admin.questions.store-question')
            ->extends('admin.layouts.admin');
    }
}
