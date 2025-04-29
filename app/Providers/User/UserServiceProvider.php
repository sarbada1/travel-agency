<?php

namespace App\Providers\User;

use App\Repositories\Account\User\UserInterface;
use App\Repositories\Account\User\UserRepository;
use App\Repositories\MemberType\MemberTypeInterface;
use App\Repositories\MemberType\MemberTypeRepository;
use App\Repositories\Profile\UserProfileInterface;
use App\Repositories\Profile\UserProfileRepository;
use App\Repositories\Team\TeamInterface;
use App\Repositories\Team\TeamRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserProfileInterface::class, UserProfileRepository::class);
        $this->app->bind(MemberTypeInterface::class, MemberTypeRepository::class);
        $this->app->bind(TeamInterface::class, TeamRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
