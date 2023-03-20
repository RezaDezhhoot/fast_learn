<?php

namespace App\Repositories\Interfaces;

use App\Models\Form;

interface FormRepositoryInterface
{
    // forms
    public function getAllAdmin($type,$search,$per_page);

    public function find($id);

    public function findOrFail($id , $published = false);

    public function destroy($id);

    public function save(Form $form);

    public function create(array $data);

    public function update(array $data , Form $form);

    public function getNewObject();

    //answers
    public function answerCreate(array $data);
}
