<?php

namespace App\Providers\AttributeGroup;

use App\Repositories\AttributeGroup\AttributeGroupInterface;
use App\Repositories\AttributeGroup\AttributeGroupRepository;
use Illuminate\Support\ServiceProvider;

class AttributeGroupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AttributeGroupInterface::class, AttributeGroupRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}