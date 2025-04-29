<?php

namespace App\Providers\News;

use App\Repositories\News\Category\NewsCategoryInterface;
use App\Repositories\News\Category\NewsCategoryRepository;
use App\Repositories\News\Detail\NewsDetailInterface;
use App\Repositories\News\Detail\NewsDetailRepository;
use App\Repositories\News\NewsInterface;
use App\Repositories\News\NewsRepository;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(NewsCategoryInterface::class, NewsCategoryRepository::class);
        $this->app->bind(NewsInterface::class, NewsRepository::class);
        $this->app->bind(NewsDetailInterface::class, NewsDetailRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
