<?php

namespace App\Providers\TourPackage;

use App\Repositories\TourPackage\TourPackageInterface;
use App\Repositories\TourPackage\TourPackageRepository;
use Illuminate\Support\ServiceProvider;

class TourPackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TourPackageInterface::class, TourPackageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}