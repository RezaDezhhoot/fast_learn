<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use Livewire\Component;

class EpisodeQuizzes extends BaseComponent
{
    public $category , $answer = 'correct_answers' , $course;

    public function mount()
    {
        $this->data['category'] = Category::query()->where('type',CategoryEnum::QUESTION)->pluck('title','id');
        $this->data['course'] = Course::query()->pluck('title','id');
        $this->data['answer'] = [
            'correct_answers' => 'پاسخ های صحیح',
            'incorrect_answers' => 'پاسخ های غلط'
        ];
    }

    public function render()
    {
        $items = Question::query()->with('answers')
            ->withCount(['answers as correct_answers' => function ($q) {
                $q->where('status', true);
            }])
            ->withCount(['answers as incorrect_answers' => function ($q) {
                $q->where('status', false);
            }])
            ->when($this->course , function ($q) {
                $q->where(function ($q){
                    $q->whereHas('episodeQuizzes' , function ($q) {
                        $q->whereHas('episode' , function ($q){
                            $q->whereHas('chapter' , function ($q) {
                                $q->whereHas('course' , function ($q) {
                                    $q->where('id' , $this->course);
                                });
                            });
                        });
                    })->orWherehas('quizzes' , function ($q) {
                        $q->whereHas('courses' , function ($q){
                            $q->where('id' , $this->course);
                        });
                    });
                });
            })
            ->when($this->category , function ($q){
                $q->whereHas('category',function ($q) {
                    $q->where('id' , $this->category);
                });
            })->orderByDesc($this->emptyToNull($this->answer) ?? 'correct_answers')->paginate(20)
        ;
        return view('admin.episode-quizzes' , get_defined_vars())->extends('admin.layouts.admin');
    }
}
