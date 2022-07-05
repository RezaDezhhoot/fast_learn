<?php


namespace App\Repositories\Interfaces;


use App\Models\Choice;

interface ChoiceRepositoryInterface
{
    public function updateOrCreate(array $key , array $values);

    public function save(Choice $choice);

    public function find($id);

    public function destroy($id);

    public function newChoiceObject();

    public function delete(Choice $choice);
}
