<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Enums\ArticleEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Livewire\WithPagination;

class IndexArticle extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status'];
    public ?string $status = null , $placeholder = 'عنوان یا نام مستعار';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->articleRepository =  app(ArticleRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = ArticleEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_articles');
        $articles = $this->articleRepository->getAllAdmin($this->search,$this->status,$this->per_page);
        return view('admin.articles.index-article',['articles'=>$articles])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_articles');
        $article = $this->articleRepository->findArticle($id,false);
        $this->articleRepository->deleteComments($article);
        $this->articleRepository->delete($article);
    }
}
