<?php

namespace Metrique\Building;

use Illuminate\Support\ServiceProvider;

class BuildingServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (!class_exists('CreatePagesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_pages_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '0_create_pages_table.php'),
                    __DIR__ . '/../database/migrations/create_contents_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '1_create_contents_table.php'),
                ], 'migrations');
            }
        }
    }
}
