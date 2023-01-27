<?php


namespace App\Repositories\Classes;

use App\Enums\SampleEnum;
use App\Models\Sample;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SampleRepository implements SampleRepositoryInterface
{
    public function findOrFail($id)
    {
        return Sample::withoutGlobalScope('published')->findOrFail($id);
    }

    public function destroy($id)
    {
        return $this->findOrFail($id)->delete();
    }

    public function getAllAdmin($search, $status, $course, $pagination)
    {
        return Sample::withoutGlobalScope('published')->latest('id')->with('course')->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        })->when($course, function ($q) use ($course) {
            return $q->whereHas('course', function ($q) use ($course) {
                return $q->where('id', $course);
            });
        })->search($search)->paginate($pagination);
    }

    public function getNewObject()
    {
        return new Sample();
    }

    public function save(Sample $sample)
    {
        $sample->save();
        return $sample;
    }

    public function getMySamples()
    {
    }

    public function download($item)
    {
        try {
            if (!$item instanceof Sample)
                $item = Sample::findOrFail($item);

            if ($disk = getDisk($item->driver)) {
                if ($disk->exists($item->file)) {
                    if ($item->type == SampleEnum::PRIVATE_TYPE) {
                        if (auth()->check()) {
                            if (!is_null($item->course_id) && auth()->user()->hasCourse($item->course_id)) {
                                $item->increment('downloads');
                                return $disk->download($item->file);
                            }
                        }
                    } elseif ($item->type == SampleEnum::PUBLIC_TYPE) {
                        $item->increment('downloads');
                        return $disk->download($item->file);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return false;
    }

    public function getAllSite($search, $category, $perPage = 10)
    {
        return Sample::latest('id')->where('type', SampleEnum::PUBLIC_TYPE)->when($search, function ($q) use ($search) {
            return $q->whereHas('course', function ($q) use ($search) {
                return $q->search($search);
            })->orWhere(function ($q) use ($search) {
                return $q->search($search);
            });
        })->when($category, function ($q) use ($category) {
            return $q->wherehas('course', function ($q) use ($category) {
                return $q->whereHas('category', function ($q) use ($category) {
                    return $q->search($category);
                });
            });
        })->paginate($perPage);
    }

    public function findBySlug($slug)
    {
        $item = Sample::where('slug', $slug)->firstOrFail();
        if ($item->type == SampleEnum::PRIVATE_TYPE) {
            if (auth()->check()) {
                if (!is_null($item->course_id) && auth()->user()->hasCourse($item->course_id)) {
                    return $item;
                }
            }
        } elseif ($item->type == SampleEnum::PUBLIC_TYPE) {
            return $item;
        }
        abort(404);
    }

    public function getRelatedSamples(Sample $sample, $take = 3)
    {
        $samples = [];
        if ($sample->course) {
            return Sample::latest('id')->where([['type', SampleEnum::PUBLIC_TYPE], ['id', '!=', $sample->id]])
                ->whereHas('course', function ($q) use ($sample) {
                    return $sample->where('id', $sample->course_id);
                })->take($take)->get();
        }
        return $samples;
    }

    public function getAllTeacher($search, $status, $course, $pagination)
    {
        return Sample::withoutGlobalScope('published')->latest('id')->whereHas('course',function ($q) use ($course){
            return $q->whereHas('teacher',function ($q){
               return $q->where('user_id',Auth::id());
            })->when($course,function ($q) use ($course) {
                return $q->where('id',$course);
            });
        })->search($search)->paginate($pagination);
    }

    public function findOrFailTeacher($id)
    {
        return Sample::withoutGlobalScope('published')->whereHas('course',function ($q) {
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->findOrFail($id);
    }
}
