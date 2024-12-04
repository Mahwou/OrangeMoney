<?php

namespace Courage\OrangeMoney\Provider;

use Illuminate\Support\ServiceProvider;

final class UssdOrangeMoneyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {

        // Publish configurations
        $this->publishes([
            __DIR__.'/../config/orange_money_ussd.php' => config_path('orange_money_ussd.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Merge package config with app config
        $this->mergeConfigFrom(
            __DIR__.'/../config/orange_money_ussd.php', 'orange_money_ussd'
        );
    }
}
