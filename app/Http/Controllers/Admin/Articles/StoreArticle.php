<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Enums\ArticleEnum;
use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;

class StoreArticle extends BaseComponent
{
    public $header , $slug , $title , $body , $category , $status = '' , $image , $seo_keywords , $seo_description, $tags = [];
    public $article;
    public array $categories = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->articleRepository = app(ArticleRepositoryInterface::class);
        $this->tagRepository = app(TagRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_articles');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->article = $this->articleRepository->findArticle($id,false);
            $this->header = $this->article->title;
            $this->slug = $this->article->slug;
            $this->title = $this->article->title;
            $this->image = $this->article->image;
            $this->body = $this->article->body;
            $this->seo_keywords = $this->article->seo_keywords;
            $this->seo_description = $this->article->seo_description;
            $this->status = $this->article->status;
            $this->category = $this->article->category_id;
            $this->tags = $this->article->tags->pluck('id','id')->toArray();
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'مقاله جدید';
        } else abort(404);
        $this->data['category'] = $this->categoryRepository->getAll(CategoryEnum::ARTICLE)->pluck('title','id');
        $this->data['status'] = ArticleEnum::getStatus();
        $this->data['tags'] = $this->tagRepository->getAll()->pluck('name','id');
    }
    public function render()
    {
        return view('admin.articles.store-article')->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_articles');
        $this->articleRepository->deleteComments($this->article);
        $this->articleRepository->delete($this->article);
        return redirect()->route('admin.article');
    }

    public function store()
    {
        $this->authorizing('edit_articles');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->article);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase( $this->articleRepository->getNewObject());
            $this->reset(['slug','title','category','image','body','seo_keywords','seo_description','status']);
        }
    }

    public function saveInDateBase($model)
    {
        $fields = [
            'title' => ['required','string','max:100'],
            'image' => ['nullable','string','max:250'],
            'body' => ['required','string','max:10000000'],
            'category' => ['required','exists:categories,id'],
            'seo_keywords' => ['required','string','max:250'],
            'seo_description' => ['required','string','max:250'],
            'status' => ['required','in:'.implode(',',array_keys(ArticleEnum::getStatus()))],
        ];
        $messages = [
            'title' => 'عنوان',
            'main_image' => 'تصویر',
            'body' => 'محتوا',
            'category' => 'دسته بندی',
            'seo_keywords' => 'کلمات کلیدی',
            'seo_description' => 'توضیحات سئو',
            'status' => 'وضعیت',
        ];
        $this->validate($fields,[],$messages);
        $model->title = $this->title;
        $model->image = $this->image ?? '';
        $model->body = $this->body;
        $model->category_id = $this->category;
        $model->seo_keywords = $this->seo_keywords;
        $model->seo_description = $this->seo_description;
        $model->status = $this->status;
        $model->user_id = auth()->id();
        $this->articleRepository->save($model);
        $this->tags = array_filter($this->tags);
        if ($this->mode == self::CREATE_MODE)
            $this->articleRepository->attachTags($model,$this->tags);
        elseif ($this->mode == self::UPDATE_MODE)
            $this->articleRepository->syncTags($model,$this->tags);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

}
