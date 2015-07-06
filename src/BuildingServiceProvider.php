<?php

namespace Metrique\Building;

use Illuminate\Support\ServiceProvider;
use Metrique\Building\Commands\BuildingMigrationsCommand;

class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {           
        // Commands
        $this->commands('command.metrique.building-migrations');

        // Views
        $this->loadViewsFrom(__DIR__.'/Resources/views/', 'building');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->bindShared('command.metrique.building-migrations', function ($app) {
            return new BuildingMigrationsCommand();
        });
    }
}