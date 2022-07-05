<?php


namespace App\Repositories\Classes;


use App\Models\Choice;
use App\Repositories\Interfaces\ChoiceRepositoryInterface;

class ChoiceRepository implements ChoiceRepositoryInterface
{
    public function updateOrCreate(array $key, array $values)
    {
        return Choice::updateOrCreate($key,$values);
    }

    public function save(Choice $choice)
    {
        $choice->save();
        return $choice;
    }

    public function find($id)
    {
        return Choice::findOrFail($id);
    }

    public function destroy($id)
    {
        return Choice::destroy($id);
    }

    public function newChoiceObject()
    {
        return new Choice();
    }

    public function delete(Choice $choice)
    {
        return $choice->delete();
    }
}
