<?php


namespace App\Repositories\Classes;


use App\Models\Episode;
use App\Models\EpisodeLike;
use App\Models\RollCall;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EpisodeRepository implements EpisodeRepositoryInterface
{
    public function destroy($id)
    {
       return Episode::destroy($id);
    }

    public function find($id)
    {
        return Episode::find($id);
    }

    public function findOrFail($id)
    {
        return Episode::with('homeworks')->findOrFail($id);
    }

    public function save(Episode $episode)
    {
        $episode->save();
        return $episode;
    }

    public function newEpisodeObject()
    {
        return new Episode();
    }

    public function findMany(array $ids)
    {
        return Episode::findMany($ids);
    }

    public function getAllAdmin($course = null , $chapter = null, $search = null, $perPage = 10)
    {
        $query =  Episode::latest('id')->with(['chapter','chapter.course'])->when($course,function ($q) use ($course){
            return $q->whereHas('chapter',function ($q) use ($course) {
                return $q->wherehas('course',function ($q) use ($course){
                    return $q->where('id',$course);
                });
            });
        })->when($chapter,function ($q) use ($chapter) {
            return $q->whereHas('chapter',function ($q) use ($chapter) {
                return $q->where('id',$chapter);
            });
        })->search($search);

        if ($perPage) {
            return $query->paginate($perPage);
        } else {
            return $query->cursor();
        }
    }

    public function getAllTeacher($course, $search, $per_page , $chapter = null)
    {
        $query = Episode::latest('id')->whereHas('chapter',function ($q) {
            return $q->whereHas('course',function ($q) {
                return $q->whereHas('teacher',function ($q){
                    return $q->where('user_id',Auth::id());
                });
            });
        })->when($chapter,function ($q) use ($chapter) {
            return $q->whereHas('chapter',function ($q) use ($chapter) {
                return $q->where('id',$chapter);
            });
        })->search($search);

        if ($per_page) {
            return $query->paginate($per_page);
        } else {
            return $query->cursor();
        }
    }

    public function findTeacherEpisode($id)
    {
        return Episode::query()->whereHas('chapter',function ($q) {
            return $q->whereHas('course',function ($q){
                return $q->whereHas('teacher',function ($q){
                    return $q->where('user_id',Auth::id());
                });
            });
        })->findOrFail($id);
    }

    public function getTeachersCount($from_date , $to_date)
    {
        return Episode::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->whereHas('chapter',function ($q) {
            return $q->whereHas('course',function ($q){
                return $q->whereHas('teacher',function ($q){
                    return $q->where('user_id',Auth::id());
                });
            });
        })->count();
    }

    public function newComment(Episode $episode, array $data)
    {
        return $episode->comments()->create($data);
    }

    public function hasLiked($episode)
    {
        $hasLikedWithIP = $episode->likes()->where('user_ip',request()->ip())->exists();
        if (\auth()->check()) {
            if (!\auth()->user()->hasLiked($episode) && !$hasLikedWithIP) {
                return false;
            }
        } elseif (! $hasLikedWithIP) {
            return false;
        }

        return true;
    }

    public function like($episode) {
        if (\auth()->check()) {
            if (! $this->hasLiked($episode)) {
                \auth()->user()->likes()->create([
                    'episode_id' => $episode->id,
                    'user_ip' => request()->ip()
                ]);
            }
        } elseif (! $this->hasLiked($episode)) {
            $episode->likes()->create([
                'user_ip' => request()->ip()
            ]);
        }
    }

    public function unLike($episode)
    {
        if (\auth()->check()) {
            if ($this->hasLiked($episode)) {
                return \auth()->user()->likes()->where('episode_id',$episode->id)->delete();
            }
        } elseif ($this->hasLiked($episode)) {
            return $episode->likes()->where('user_ip',request()->ip())->delete();
        }
    }

    public function hasReported(Episode $episode)
    {
        $hasReportedWithIP = $episode->reports()->where('user_ip',request()->ip())->exists();
        if (\auth()->check()) {
            if (!$episode->reports()->where('user_id',\auth()->id())->exists() && !$hasReportedWithIP) {
                return false;
            }
        } elseif (! $hasReportedWithIP) {
            return false;
        }

        return true;
    }

    public function submitReport(Episode $episode,$subject)
    {
        if (\auth()->check()) {
            if (! $this->hasReported($episode)) {
                $episode->reports()->create([
                    'user_ip' => request()->ip(),
                    'user_id' => \auth()->id(),
                    'subject' => $subject,
                ]);
                return true;
            }
        } elseif (! $this->hasReported($episode)) {
            $episode->reports()->create([
                'user_ip' => request()->ip(),
                'subject' => $subject
            ]);
            return true;
        }

        return false;
    }

    public function submitRollCall($episode_id , $details_id, $user_id, $status)
    {
        RollCall::query()
            ->updateOrCreate([
                'episode_id' => $episode_id,
                'order_detail_id' => $details_id,
                'user_id' => $user_id
            ],[
                'status' => $status
            ]);
    }

    public function checkEpisodeForRollCall($episode_id, $details_id, $user_id)
    {
        return Episode::query()->whereHas('chapter',function ($q) use ($user_id,$details_id){
                return $q->whereHas('course',function ($q) use ($user_id,$details_id){
                   return $q->whereHas('details',function ($q) use ($user_id,$details_id) {
                       return $q->where('id',$details_id)->whereHas('order',function ($q) use ($user_id){
                          return $q->where('user_id',$user_id);
                       });
                   })->whereHas('teacher',function ($q) {
                       return $q->where('id',\auth()->id());
                   });
                });
            })->where('id',$episode_id)->exists();
    }
}
