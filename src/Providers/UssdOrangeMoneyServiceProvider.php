<?php

namespace Courage\OrangeMoney\Providers;

use Illuminate\Support\ServiceProvider;

class UssdOrangeMoneyServiceProvider extends ServiceProvider
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
            __DIR__.'/../config/orange_money.php' => config_path('orange_money.php'),
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
            __DIR__.'/../config/orange_money.php', 'orange_money'
        );
    }
}