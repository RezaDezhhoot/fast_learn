<?php

namespace App\Repositories\Classes;

use App\Models\Form;
use App\Models\FormAnswer;
use App\Repositories\Interfaces\FormRepositoryInterface;

class FormRepository implements FormRepositoryInterface
{

    public function getAllAdmin($type, $search, $per_page)
    {
        return Form::query()
            ->latest()->when($type,function ($q) use ($type){
               return $q->where('type',$type);
            })->search($search)->paginate($per_page);
    }

    public function find($id)
    {
        return Form::query()->find($id);
    }

    public function findOrFail($id , $published = false)
    {
        return Form::query()->published($published)->findOrFail($id);
    }

    public function all()
    {
        return Form::all();
    }

    public function destroy($id)
    {
        return Form::destroy($id);
    }

    public function save(Form $form)
    {
        $form->save();
        return $form;
    }

    public function create(array $data)
    {
        return Form::query()->create($data);
    }

    public function update(array $data, Form $form)
    {
        $form->update($data);
        return $form;
    }

    public function getNewObject()
    {
        return new Form();
    }

    public function answerCreate(array $data)
    {
        return FormAnswer::query()->create($data);
    }

    public static function newItems()
    {
        return FormAnswer::query()->where('status',false)->count();
    }

    public function answerGetAllAdmin($subject, $search, $per_page)
    {
        return FormAnswer::query()->with(['form','user'])
            ->when($subject,function ($q) use ($subject) {
               return $q->where('subject',$subject);
            })->when($search,function ($q) use ($search){
                return $q->whereHas('user',function ($q) use ($search){
                    return $q->search($search);
                })->orWhereHas('form',function ($q) use ($search){
                    return $q->search($search);
                });
            })->paginate($per_page);
    }

    public function answerDestroy($id)
    {
        return FormAnswer::destroy($id);
    }

    public function answerFindOrFail($id)
    {
        return FormAnswer::query()->findOrFail($id);
    }

    public function answerUpdate(array $data, FormAnswer $formAnswer)
    {
        $formAnswer->update($data);
        return $formAnswer;
    }
}
