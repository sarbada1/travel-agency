<?php

namespace App\Providers\Blog;

use App\Repositories\Blogs\BlogsInterface;
use App\Repositories\Blogs\BlogsRepository;
use App\Repositories\Blogs\Category\BlogCategoryInterface;
use App\Repositories\Blogs\Category\BlogCategoryRepository;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BlogCategoryInterface::class, BlogCategoryRepository::class);
        $this->app->bind(BlogsInterface::class, BlogsRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
