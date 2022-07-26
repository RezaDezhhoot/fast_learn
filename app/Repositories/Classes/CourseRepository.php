<?php


namespace App\Repositories\Classes;

use App\Enums\CourseEnum;
use App\Enums\OrderEnum;
use App\Models\Course;
use App\Observers\CourseObserver;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAllAdmin($search , $status, $category, $per_page, $type)
    {
        return Course::latest('id')->when($category,function ($q) use ($category){
            return $q->wherehas('category',function ($q) use ($category) {
                return $q->where('id',$category);
            });
        })->when($status,function ($q) use ($status){
            return $q->where('status', $status);
        })->when($type,function ($q) use ($type){
            return $q->where('type', $type);
        })->search($search)->paginate($per_page);
    }

    public function getAllSite($search = null, $orderBy = null, $type = null, $category = null , $teacher = null, $property = null)
    {
        return Course::published()->when($type, function($q) use ($type) {
            return match ($type) {
                'free' => $q->where('const_price',0),
                'cash' => $q->where('const_price','>',0),
                default => $q,
            };
        })->when($orderBy , function ($q) use ($orderBy) {
            return match ($orderBy) {
                'latest' => $q->latest('id'),
                'oldest' =>  $q->oldest('id'),
                'expensive' =>  $q->orderBy('const_price','desc'),
                'inexpensive' => $q->orderBy('const_price'),
                CourseEnum::HOLDING => $q->where('status',CourseEnum::HOLDING),
                CourseEnum::FINISHED => $q->where('status',CourseEnum::FINISHED),
                default => $q,
            };
        })->when($category,function ($q) use ($category) {
            $categoryRepository = app(CategoryRepositoryInterface::class);
            if ($categories = $categoryRepository->get([['slug',$category]],'first')) {
                $ids = array_value_recursive('id',$categories->toArray());
                return $q->whereIn('category_id',$ids);
            }
            return null;
        })->when($search,function ($q) use ($search) {
            return $q->where('title',$search)->orWhere('slug',$search)->orWhereHas('tags',function ($q) use ($search){
                return $q->where('name',$search);
            });
        })->when($teacher , function ($q) use ($teacher){
            return $q->where('teacher_id',base64_decode($teacher));
        })->when($property , function ($q) use ($property){
            return $q->where('type',$property);
        })->hasCategory()->paginate(9);
    }

    public function save(Course $course): Course
    {
        $course->save();
        return $course;
    }

    public function delete(Course $course): ?bool
    {
        return $course->delete();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        return Course::with('episodes')->findOrFail($id);
    }

    public function attachTags(Course $course, array $tags)
    {
        $course->tags()->attach($tags);
    }

    public function syncTags(Course $course, array $tags)
    {
        $course->tags()->sync($tags);
    }

    public function newCourseObject(): Course
    {
        return new Course();
    }

    public function getAll()
    {
        return Course::published()->with('episodes')->cursor();
    }

    public function get($col, $value , $published = false)
    {
        return $published ? Course::published()->with(['episodes','comments'])->where($col,$value)->firstOrfail() : Course::where($col,$value)->with(['episodes','comments'])->firstOrfail();
    }

    public function whereIn($col, array $value , $take = false , $published = false , $where = [])
    {
        return $published ?
            ($take ? Course::published()->where($where)->whereIn($col,$value)->take($take)->get() : Course::published()->where($where)->whereIn($col,$value)->get()) :
            ($take ? Course::whereIn($col,$value)->where($where)->take($take)->get() : Course::whereIn($col,$value)->where($where)->get()) ;
    }

    public function newComment(Course $course, array $data): Model
    {
        return $course->comments()->create($data);
    }

    public function getEpisodes(Course $course , $withTrashed = false)
    {
        return $course->episodes;
    }

    public function count()
    {
        return Course::count();
    }

    public function getMostSoldCourses($from_date ,$to_date)
    {
        return Course::select(['id','title'])->withCount(['details' => function($q) use ($from_date ,$to_date) {
            return $q->where('status', OrderEnum::STATUS_COMPLETED)
                ->whereBetween('created_at', [$from_date.' 00:00:00', $to_date.' 23:59:59']);
        }])->whereHas('details', function($q) use ($from_date ,$to_date) {
            return $q->where('status', OrderEnum::STATUS_COMPLETED)
                ->whereBetween('created_at', [$from_date.' 00:00:00', $to_date.' 23:59:59']);
        })->cursor()->sortByDesc('details_count');
    }

    public static function observe()
    {
        Course::observe(CourseObserver::class);
    }

    public function increment(Course $course, int $int)
    {
        $course->increment('views',$int);
    }
}
