<?php

namespace App\Providers\Setting;

use App\Repositories\Setting\SettingInterface;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SettingInterface::class, SettingRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
