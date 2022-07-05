<?php


namespace App\Repositories\Classes;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function destroy($id)
    {
        return Tag::destroy($id);
    }

    public function find($id)
    {
        return Tag::findOrFail($id);
    }

    public function delete(Tag $tag)
    {
        return $tag->delete();
    }

    public function getAllAdmin($search, $per_page)
    {
        return Tag::latest('id')->search($search)->paginate($per_page);
    }

    public function newTagObject()
    {
        return new Tag();
    }

    public function save(Tag $tag)
    {
        $tag->save();
        return $tag;
    }

    public function getAll()
    {
        return Tag::all();
    }
}
