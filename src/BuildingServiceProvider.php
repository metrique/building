<?php

namespace Metrique\Building;

use Illuminate\Support\ServiceProvider;
use Metrique\Building\Building;
use Metrique\Building\Commands\BuildingMigrationsCommand;
use Metrique\Building\Contracts\BuildingIndexRepositoryInterface;
use Metrique\Building\EloquentBuildingIndexRepository;

class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->loadViewsFrom(__DIR__.'/Resources/views/', 'metrique-building');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
<<<<<<< HEAD
        $this->registerBuildingFacade();
=======
        // Decorate with caching repository.
        $this->app->bind(
            BuildingIndexRepositoryInterface::class,
            function($app) {
                $eloquentRepository = new EloquentBuildingIndexRepository($this->app);

                // Decorate with caching
                $cachingRepository = new CachingBuildingIndexRepository($this->app, $eloquentRepository);

                return $cachingRepository;
            }
        );

>>>>>>> origin/master
        $this->registerCommands();
    }

    /**
     * Register the Building Facade
     * 
     * @return void
     */
    private function registerBuildingFacade()
    {
        $this->app->bind('\Metrique\Building\Building', function(){
            return new Building($this->app);
        });
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Riak\Contracts\Connection'];
    }


}