<?php


namespace App\Repositories\Classes;

use App\Models\Quiz;
use App\Repositories\Interfaces\QuizRepositoryInterface;

class QuizRepository implements QuizRepositoryInterface
{
    public function getAllAdmin($search, $per_page)
    {
        return Quiz::latest('id')->search($search)->paginate($per_page);
    }

    public function find($id)
    {
        return Quiz::findOrFail($id);
    }

    public function delete(Quiz $quiz)
    {
        return $quiz->delete();
    }

    public function destroy($id)
    {
        return Quiz::destroy($id);
    }

    public function save(Quiz $quiz)
    {
       $quiz->save();
       return $quiz;
    }

    public function newQuizObject()
    {
        return new Quiz();
    }

    public function syncQuestions(Quiz $quiz, array $questions)
    {
        $quiz->questions()->sync($questions);
    }

    public function attachQuestions(Quiz $quiz, array $questions)
    {
        $quiz->questions()->attach($questions);
    }

    public function getAll()
    {
        return Quiz::all();
    }

    public function startQuiz(Quiz $quiz, int $seed = 0)
    {
        return $quiz->questions()->inRandomOrder($seed)->paginate(1);
    }
    public function count()
    {
        return Quiz::count();
    }
}
