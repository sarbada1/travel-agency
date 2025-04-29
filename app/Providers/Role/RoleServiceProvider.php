<?php

namespace App\Providers\Role;

use App\Repositories\Roles\RolesInterface;
use App\Repositories\Roles\RolesRepository;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RolesInterface::class, RolesRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
