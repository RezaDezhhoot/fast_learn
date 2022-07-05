<?php


namespace App\Repositories\Interfaces;


use App\Models\Tag;

interface TagRepositoryInterface
{
    public function destroy($id);

    public function find($id);

    public function delete(Tag $tag);

    public function getAllAdmin($search , $per_page);

    public function newTagObject();

    public function save(Tag $tag);

    public function getAll();
}
