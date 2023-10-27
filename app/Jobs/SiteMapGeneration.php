<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SiteMapGeneration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $method;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($method)
    {
        $this->method = $method;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0);

        if (is_string($this->method) == 'string' && $this->method == 'automatic') {
            $sitemap = SitemapGenerator::create(env('APP_URL'))
                ->getSitemap()
                ->writeToFile(public_path('sitemap.xml'));
        } elseif (is_array($this->method)) {
            $sitemap = Sitemap::create(env('APP_URL'));
            if (isset($this->method['articles']) && $this->method['articles']) {
                $sitemap->add(route('articles'));
                Article::query()
                    ->latest()
                    ->published()
                    ->chunkById(200,function ($articles) use ($sitemap){
                        $sitemap->add($articles);
                    });
            }

            if (isset($this->method['courses']) && $this->method['courses']) {
                $sitemap->add(route('courses'));
                Course::query()->latest()
                    ->published()
                    ->chunkById(200,function ($courses) use ($sitemap){
                        $sitemap->add($courses);
                    });
            }
            if (isset($this->method['images'])) {
                foreach ($this->method['images'] as $image) {
                    $sitemap->add(Url::create(env('APP_URL'))->addImage($image['image'],$image['title'] ?? ''));
                }
            }
            if (isset($this->method['home']) && $this->method['home']) {
                $sitemap->add(route('home'));
            }
            if (isset($this->method['settings']) && $this->method['settings']) {
                $sitemap->add(route('contact'));
                $sitemap->add(route('about'));
                $sitemap->add(route('fag'));
                $sitemap->add(route('auth'));
            }
            if (isset($this->method['pages'])) {
                $sitemap->add($this->method['pages']);
            }

            $sitemap->writeToFile(public_path('sitemap.xml'));
        }
    }
}
