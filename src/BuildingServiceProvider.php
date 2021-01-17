<?php

namespace Metrique\Building;

use Illuminate\Support\ServiceProvider;
use Metrique\Building\Services\BuildingService;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Services\FormBuilder;
use Metrique\Building\Services\FormBuilderInterface;

class BuildingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'building');
    }

    public function boot()
    {
        $this->app->singleton(BuildingServiceInterface::class, BuildingService::class);
        $this->app->singleton(FormBuilderInterface::class, FormBuilder::class);

        if ($this->app->runningInConsole()) {
            if (!class_exists('CreatePagesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_pages_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_pages_table.php'),
                ], 'migrations');

                $this->publishes([
                    __DIR__.'/../config/config.php' => config_path('building.php'),
                ], 'config');
            }
        }
    }
}
