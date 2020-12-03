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
        if($this->app->runningInConsole()) {
            if(!class_exists('CreatePagesTable')) {
                $this->publishes([
                    __DIR__ . '../databases/migrations/create_pages_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_pages_table.php'),
                ], 'migrations');
            }
        }
    }
}
