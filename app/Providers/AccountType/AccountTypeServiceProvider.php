<?php

namespace App\Providers\AccountType;

use App\Repositories\Account\AccountType\AccountTypeInterface;
use App\Repositories\Account\AccountType\AccountTypeRepository;
use Illuminate\Support\ServiceProvider;

class AccountTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AccountTypeInterface::class, AccountTypeRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
