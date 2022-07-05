<?php


namespace App\Repositories\Interfaces;


use App\Models\Question;

interface QuestionRepositoryInterface
{
    public function find($id);

    public function findByPK($id);

    public function delete(Question $question);

    public function getAllAdmin($search , $category , $per_page);

    public function newQuestionObject();

    public function save(Question $question);

    public function findMany(array $ids);

    public function count();
}
