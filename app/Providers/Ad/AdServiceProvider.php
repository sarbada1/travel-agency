<?php

namespace App\Providers\Ad;

use App\View\Components\AdDisplay;
use App\Repositories\Ad\AdInterface;
use App\Repositories\Ad\AdRepository;
use Illuminate\Support\Facades\Blade;
use App\Repositories\Ad\AdSetInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Ad\AdSetRepository;
use App\Repositories\Ad\CampaignInterface;
use App\Repositories\Ad\CampaignRepository;
use App\Repositories\Ad\AdPositionInterface;
use App\Repositories\Ad\AdPlacementInterface;
use App\Repositories\Ad\AdPositionRepository;
use App\Repositories\Ad\AdPlacementRepository;

class AdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AdInterface::class, AdRepository::class);
        $this->app->bind(AdPositionInterface::class, AdPositionRepository::class);
        $this->app->bind(AdPlacementInterface::class, AdPlacementRepository::class);
        $this->app->bind(CampaignInterface::class, CampaignRepository::class);
        $this->app->bind(AdSetInterface::class, AdSetRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register ad display component
    }
}