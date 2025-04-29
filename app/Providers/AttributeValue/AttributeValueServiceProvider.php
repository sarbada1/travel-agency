<?php

namespace App\Providers\AttributeValue;

use App\Repositories\AttributeValue\AttributeValueInterface;
use App\Repositories\AttributeValue\AttributeValueRepository;
use Illuminate\Support\ServiceProvider;

class AttributeValueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AttributeValueInterface::class, AttributeValueRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}