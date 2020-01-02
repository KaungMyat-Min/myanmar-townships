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
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

    }
}
