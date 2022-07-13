<?php


namespace App\Repositories\Interfaces;


use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function getAllAdmin($search , $status, $pagination);

    public function getAllSite($search = null,$category =null);

    public function delete(Article $article);

    public function deleteComments(Article $article);

    public function update(Article $article , array $data);

    public function save(Article $article);

    public function findArticle($id , $active = true);

    public function getNewObject();

    public function attachTags(Article $article , array $tags);

    public function syncTags(Article $article , array $tags);

    public function get(array $where,$published = true);

    public function whereIn($col,array $value, $take = false, $published = false, $where = []);

    public function newComment(Article $article , array $data);

    public function count();

    public function getAll();
}
