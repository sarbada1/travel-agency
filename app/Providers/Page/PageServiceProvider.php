<?php

namespace App\Providers\Page;

use App\Repositories\Page\PageInterface;
use App\Repositories\Page\PageRepository;
use App\Repositories\Testimonial\TestimonialInterface;
use App\Repositories\Testimonial\TestimonialRepository;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PageInterface::class, PageRepository::class);
        $this->app->bind(TestimonialInterface::class, TestimonialRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
