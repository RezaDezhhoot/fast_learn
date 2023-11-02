<?php

namespace App\Console\Commands;

use App\Jobs\SiteMapGeneration;
use App\Models\Article;
use App\Models\Course;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class SiteMapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate {--courses} {--articles} {--home} {--settings} {--custom_pages=} {--automatic} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('automatic')) {
            $methods = 'automatic';
        } else {
            $methods = [];

            $methods['courses'] = $this->option('courses');
            $methods['articles'] = $this->option('articles');
            $methods['home'] = $this->option('home');
            $methods['settings'] = $this->option('settings');

            if ($this->option('custom_pages')) {
                $pages = explode(',',$this->option('custom_pages'));
                $methods['pages'] = $pages;
            }
        }

        dispatch(new SiteMapGeneration($methods));
        return Command::SUCCESS;
    }
}
