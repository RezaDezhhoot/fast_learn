<?php


namespace App\Repositories\Classes;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ArticleRepository  implements ArticleRepositoryInterface
{
    public function getAllAdmin($search, $status, $type , $pagination)
    {
        return Article::query()->latest('id')->when($type,function ($q) use ($type) {
            return $q->where('type',$type);
        })->when($status,function ($query) use ($status){
            return $query->where('status',$status);
        })->search($search)->paginate($pagination);
    }

    public function delete(Article $article)
    {
        return $article->delete();
    }

    public function deleteComments(Article $article)
    {
        return $article->comments()->delete();
    }

    public function update(Article $article, array $data)
    {
        return $article->update($data);
    }

    public function save(Article $article)
    {
        $article->save();
        return $article;
    }

    public function getAll()
    {
        return Article::all();
    }

    public function findArticle($id , $active = true)
    {
        return Article::published($active)->findOrFail($id);
    }

    public function getNewObject()
    {
        return new Article();
    }

    public function attachTags(Article $article, array $tags)
    {
        $article->tags()->attach($tags);
    }

    public function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }

    public function getAllSite($search = null, $type = null, $category = null)
    {
        return Article::published(true)->with('category')->when($type,function ($q) use ($type) {
            return $q->where('type',$type);
        })->when($category,function ($q) use ($category){
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
        })->hasCategory()->paginate(6);
    }

    public function get(array $where, $published = true)
    {
        return Article::published($published)->hasCategory()->where($where)->firstOrFail();
    }

    public function whereIn($col, array $value , $take = false , $published = false , $where = [])
    {
        return $take ? Article::published($published)->where($where)->whereIn($col,$value)->take($take)->get() :
            Article::published($published)->where($where)->whereIn($col,$value)->get();
    }

    public function newComment(Article $article, array $data): \Illuminate\Database\Eloquent\Model
    {
        return $article->comments()->create($data);
    }

    public function count()
    {
        return Article::count();
    }

    public function download($item)
    {
        try {
            if (!$item instanceof Article)
                $item = Article::findOrFail($item);

            if ($disk = getDisk($item->driver)) {
                if ($disk->exists($item->file)) {
                    return $disk->download($item->file);
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return false;
    }
}
