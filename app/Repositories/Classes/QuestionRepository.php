<?php


namespace App\Repositories\Classes;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Question::with(['choices'])->findOrFail($id);
    }

    public function findByPK($id)
    {
        return Question::find($id);
    }

    /**
     * @param Question $question
     * @return mixed
     */
    public function delete(Question $question)
    {
        return $question->delete();
    }

    public function getAllAdmin($search, $category, $per_page)
    {
        return Question::latest('id')->when($category,function ($query) use ($category){
            return $query->whereHas('category',function ($query) use ($category){
               return $query->where('id',$category);
            });
        })->search($search)->paginate($per_page);
    }

    public function newQuestionObject()
    {
        return new Question();
    }

    public function save(Question $question)
    {
        $question->save();
        return $question;
    }

    public function findMany(array $ids)
    {
        return Question::findMany($ids);
    }

    public function count()
    {
        return Question::count();
    }
}
