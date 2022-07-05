<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $repositories = array_merge_recursive(
            $this->get_classes(app_path('Repositories/Interfaces/'),"App\\Repositories\\Interfaces\\"),
            $this->get_classes(app_path('Repositories/Classes/'),"App\\Repositories\\Classes\\")
        );
        foreach ($repositories as $item)
            if (isset($item[1]) && !empty($item[1]))
                $this->app->bind("$item[0]","$item[1]");
    }

    private function get_classes($path, $namespace): array
    {
        $out = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $path
            ), RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            if ($item->isReadable() && $item->isFile() && mb_strtolower($item->getExtension()) === 'php'){
                $out[str_replace('Interface','',mb_substr($item->getRealPath(), mb_strlen($path), -4))] =  $namespace .
                    str_replace("/", "\\", mb_substr($item->getRealPath(), mb_strlen($path), -4));
            }
        }
        return $out;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
