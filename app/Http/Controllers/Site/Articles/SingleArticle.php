<?php

namespace App\Http\Controllers\Site\Articles;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SingleArticle extends BaseComponent
{
    public mixed $related_posts , $comments , $recaptcha , $commentCount = 10 ,  $actionComment = 'new' , $actionLabel = 'دیدگاه جدید' ;
    public ?string $comment = null;
    public object $article;

    public ?string $q = null;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->articleRepository = app(ArticleRepositoryInterface::class);
    }

    public function search()
    {
        //
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount($slug)
    {
        $this->article = $this->articleRepository->get([['slug',$slug]],true);
        SEOMeta::setTitle($this->article->title);
        SEOMeta::setDescription($this->article->seo_description);
        SEOMeta::addKeyword($this->article->seo_keywords);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->article->title);
        OpenGraph::setDescription($this->article->seo_description);
        TwitterCard::setTitle($this->article->title);
        TwitterCard::setDescription($this->article->seo_description);
        JsonLd::setTitle($this->article->title);
        JsonLd::setDescription($this->article->seo_description);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'articles' => ['link' => route('articles') , 'label' => 'مقالات'],
            'category' => ['link' => route('courses',['category' => $this->article->category_id]) ,'label' => $this->article->category->title],
            'article' => ['link' => '' , 'label' => $this->article->title],
        ];
        $ids = array_value_recursive('id',$this->categoryRepository->find($this->article->category_id)->toArray());
        $this->related_posts = $this->articleRepository->whereIn('category_id',$ids,3,true,[['id' , '!=' , $this->article->id]]);
        $this->comments = $this->article->comments;
    }
    public function render()
    {
        return view('site.articles.single-article')->extends('site.layouts.site.site');
    }

    public function updatedActionComment($value)
    {
        $this->actionLabel = $value != 'new' ? 'ارسال پاسخ' : 'دیدگاه جدید';
    }

    public function new_comment()
    {
        $this->validate([
            'comment' => ['required','string','max:255'],
            'recaptcha' => ['required', new ReCaptchaRule],
        ],[],[
            'comment' => 'متن',
            'recaptcha' => 'کلید امنیتی'
        ]);
        if (!auth()->check())
            return $this->addError('comment','لطفا ابتدا ثبت نام کنید');

        $data = [
            'user_id' => auth()->id(),
            'content' => $this->comment,
            'parent_id'=> $this->actionComment ?? null,
        ];

        $this->articleRepository->newComment($this->article,$data);
        $this->reset(['comment','actionLabel','actionComment']);
        return $this->emitNotify('دیدگاه با موفقیت ثبت شد');
    }

    public function moreComment()
    {
        $this->commentCount = $this->commentCount + 10;
    }
}
