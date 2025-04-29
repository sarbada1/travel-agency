<?php

namespace App\Providers\GlobalDataShare;

use App\Models\Setting\Setting;
use App\Models\User\AccountType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalDataShareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingData = Setting::first();
        $accountTypeData = AccountType::where('name', '!=', 'admin')->get();
        View::share('settingData', $settingData);
        View::share('accountTypeData', $accountTypeData);
    }
}
