<?php

namespace App\Providers\Banner;

use App\Repositories\Banner\BannerInterface;
use App\Repositories\Banner\BannerRepository;
use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BannerInterface::class, BannerRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
