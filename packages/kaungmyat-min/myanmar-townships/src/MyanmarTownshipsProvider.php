<?php

namespace MyanmarTownships;

use Illuminate\Support\ServiceProvider;

class MyanmarTownshipsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/config/myanmar-township.php' => config_path('myanmar-townships.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/myanmar-townships.php', 'myanmar-township');
        $this->mergeConfigFrom(__DIR__ . '/config/township.php', 'township');
    }
}
