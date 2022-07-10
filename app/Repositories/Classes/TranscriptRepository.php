<?php


namespace App\Repositories\Classes;

use App\Models\Transcript;
use App\Models\User;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TranscriptRepository implements TranscriptRepositoryInterface
{
    private static ?TranscriptRepository $instance = null;

    public static function getInstance(): TranscriptRepository|static
    {
        if (is_null(self::$instance))
            self::$instance = new static;

        return self::$instance;
    }

    public function getAllAdmin($search, $result, $per_page)
    {
        return Transcript::latest('id')->with(['user','quiz'])->when($result,function ($q) use ($result){
           return $q->where('result',$result);
        })->when($search,function ($q) use ($search) {
            return $q->whereHas('user',function ($q) use ($search) {
                return $q->where('phone',$search);
            })->orWhere('id',$search)->orWhere('certificate_code',$search);
        })->paginate($per_page);
    }

    public function find($id , User $user = null): Model|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return is_null($user) ? Transcript::findOrFail($id) : $user->transcripts()->findOrFail($id);
    }

    public function destroy($id)
    {
        return Transcript::destroy($id);
    }

    public function save(Transcript $transcript)
    {
        $transcript->save();
        return $transcript;
    }

   public function create( array $data)
   {
       return Transcript::create($data);
   }

   public function get(array $where)
   {
       return Transcript::where($where)->with(['quiz'])->firstOrFail();
   }

   public function attachAnswer(Transcript $transcript , $question_id,  $data): Model
   {
       return $transcript->answers()->updateOrCreate([
           'transcript_id' => $transcript->id,
           'question_id' => $question_id
       ],$data);
   }

    public function detachAnswer(Transcript $transcript ,  $data)
    {
        return $transcript->answers()->detach($data);
    }

    public function deleteAnswer(Transcript $transcript, $question_id = [])
    {
        $transcript->answers()->whereIn('question_id',$question_id)->delete();
    }

    public function count()
    {
        return Transcript::count();
    }
}
