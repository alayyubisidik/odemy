<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SettingService::class, function () {
            return new SettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $paymentGatewaySetting = $this->app->make(SettingService::class);
        $paymentGatewaySetting->setGlobalSettings();
    }
}
