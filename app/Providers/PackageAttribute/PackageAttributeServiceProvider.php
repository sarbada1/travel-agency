<?php

namespace App\Providers\PackageAttribute;

use App\Repositories\PackageAttribute\PackageAttributeInterface;
use App\Repositories\PackageAttribute\PackageAttributeRepository;
use Illuminate\Support\ServiceProvider;

class PackageAttributeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PackageAttributeInterface::class, PackageAttributeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}