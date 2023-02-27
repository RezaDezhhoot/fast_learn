<?php


namespace App\Repositories\Interfaces;


use App\Models\Quiz;

interface QuizRepositoryInterface
{
    public function getAllAdmin($search , $per_page);

    public function find($id);

    public function delete(Quiz $quiz);

    public function destroy($id);

    public function save(Quiz $quiz);

    public function newQuizObject();

    public function syncQuestions(Quiz $quiz , array $questions);

    public function attachQuestions(Quiz $quiz ,array $questions);

    public function getAll();

    public function startQuiz(Quiz $quiz , int $seed = 0);

    public function count();

    public function process($answers , $transcript);
}
