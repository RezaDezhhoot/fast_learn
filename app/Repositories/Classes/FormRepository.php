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
}
