<?php

namespace Metrique\Building;

use Collective\Html\HtmlServiceProvider;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Metrique\Building\Contracts\ComponentRepositoryInterface;
use Metrique\Building\Repositories\ComponentRepositoryEloquent;
use Metrique\Building\Contracts\Component\StructureRepositoryInterface;
use Metrique\Building\Repositories\Component\StructureRepositoryEloquent;
use Metrique\Building\Contracts\Component\TypeRepositoryInterface;
use Metrique\Building\Repositories\Component\TypeRepositoryEloquent;
use Metrique\Building\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\PageRepositoryEloquent;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Repositories\Page\ContentRepositoryEloquent;
use Metrique\Building\Contracts\Page\GroupRepositoryInterface;
use Metrique\Building\Repositories\Page\GroupRepositoryEloquent;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface;
use Metrique\Building\Repositories\Page\SectionRepositoryEloquent;
use Metrique\Building\Http\Composers\BuildingViewComposer;
use Metrique\Building\Commands\BuildingSeedsCommand;

class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */

    public function __construct($app)
    {
        parent::__construct($app);

        // Register Routes
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        // Register other packages.
        $this->html = new HtmlServiceProvider($app);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Commands
        $this->commands('command.metrique.building-seed');

        // Config
        $this->publishes([
            __DIR__.'/Resources/config/metrique-building.php' => config_path('metrique-building.php')
        ], 'metrique-building');

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/Resources/migrations');

        // Views
        $views = __DIR__ . '/Resources/views/';
        $this->loadViewsFrom($views, 'metrique-building');

        view()->composer('*', BuildingViewComposer::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Facade
        $this->registerBuildingFacade();

        // Repositories
        $this->registerComponents();
        $this->registerPages();

        // Commands
        $this->registerCommands();

        // Html
        $this->html->register();
    }

    /**
     * Register the Building Facade.
     */
    private function registerBuildingFacade()
    {
        $this->app->bind('\Metrique\Building\Building', function () {
            return new Building($this->app);
        });
    }

    private function registerComponents()
    {
        // Component
        $this->app->bind(
            ComponentRepositoryInterface::class,
            ComponentRepositoryEloquent::class
        );

        // Component type
        $this->app->bind(
            TypeRepositoryInterface::class,
            TypeRepositoryEloquent::class
        );

        // Component structure
        $this->app->bind(
            StructureRepositoryInterface::class,
            StructureRepositoryEloquent::class
        );
    }

    private function registerPages()
    {
        // Page
        $this->app->bind(
            PageRepositoryInterface::class,
            PageRepositoryEloquent::class
        );

        // Page contents
        $this->app->bind(
            ContentRepositoryInterface::class,
            ContentRepositoryEloquent::class
        );

        // Page sections
        $this->app->bind(
            SectionRepositoryInterface::class,
            SectionRepositoryEloquent::class
        );

        // Page sections
        $this->app->bind(
            GroupRepositoryInterface::class,
            GroupRepositoryEloquent::class
        );
    }

    /**
     * Register the artisan commands.
     */
    private function registerCommands()
    {
        $this->app->singleton('command.metrique.building-seed', function ($app) {
            return new BuildingSeedsCommand();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            // 'Metrique\Building\Contracts\ComponentTypeRepositoryInterface',
            // 'Metrique\Building\Repositories\ComponentTypeRepositoryEloquent'
        ];
    }
}
