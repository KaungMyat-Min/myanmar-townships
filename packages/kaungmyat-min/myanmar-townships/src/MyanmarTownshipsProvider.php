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
        $this->app->bind("MyanmarTownships\App\Helpers\Contracts\MyanmarTownship",
            "MyanmarTownships\App\Helpers\MyanmarTownshipImpl");

        $this->app->bind("MyanmarTownships\App\Helpers\Contracts\FontConverter",
            "MyanmarTownships\App\Helpers\FontConverterImpl");
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

        $this->mergeConfigFrom(__DIR__ . '/config/myanmar-townships.php', 'myanmar-townships');
        $this->mergeConfigFrom(__DIR__ . '/config/township.php', 'township');
    }
}
