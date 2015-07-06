<?php

namespace Metrique\Block;

use Illuminate\Support\ServiceProvider;
use Metrique\Block\Commands\BlockMigrationsCommand;

class BlockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {           
        // Commands
        $this->commands('command.metrique.block-migrations');

        // Views
        $this->loadViewsFrom(__DIR__.'/Resources/views/', 'block');
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
        $this->app->bindShared('command.metrique.block-migrations', function ($app) {
            return new BlockMigrationsCommand();
        });
    }
}