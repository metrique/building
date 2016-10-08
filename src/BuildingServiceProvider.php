<?php

namespace Metrique\Building;

use Collective\Html\HtmlServiceProvider;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Metrique\Building\Repositories\Contracts\ComponentRepositoryInterface;
use Metrique\Building\Repositories\ComponentRepositoryEloquent;
use Metrique\Building\Repositories\Contracts\Component\StructureRepositoryInterface;
use Metrique\Building\Repositories\Component\StructureRepositoryEloquent;
use Metrique\Building\Repositories\Contracts\Component\TypeRepositoryInterface;
use Metrique\Building\Repositories\Component\TypeRepositoryEloquent;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\PageRepositoryEloquent;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Repositories\Page\ContentRepositoryEloquent;
use Metrique\Building\Repositories\Contracts\Page\GroupRepositoryInterface;
use Metrique\Building\Repositories\Page\GroupRepositoryEloquent;
use Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface;
use Metrique\Building\Repositories\Page\SectionRepositoryEloquent;
use Metrique\Building\Http\Composers\BuildingViewComposer;
use Metrique\Building\Commands\BuildingSeedsCommand;
use DH\Eloquent\Page;

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

        // Register other packages.
        $this->html = new HtmlServiceProvider($app);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->bootCommands();
        $this->bootConfig();
        $this->bootMigrations();
        $this->bootRoutes();
        $this->bootViews();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Repositories
        $this->registerComponent();
        $this->registerComponentType();
        $this->registerComponentStructure();
        $this->registerPage();
        $this->registerPageContent();
        $this->registerPageSection();
        $this->registerPageGroup();

        // Commands
        $this->registerCommands();

        // Html
        $this->html->register();
    }

    public function bootCommands()
    {
        $this->commands('command.metrique.building-seed');
    }

    public function bootConfig()
    {
        $this->publishes([
            __DIR__.'/Resources/config/building.php' => config_path('building.php')
        ], 'building-config');

        $this->mergeConfigFrom(
            __DIR__.'/Resources/config/building.php',
            'building'
        );
    }

    public function bootMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    public function bootRoutes()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Routes/api.php';
            require __DIR__.'/Routes/web.php';
        }
    }

    public function bootViews()
    {
        $views = __DIR__ . '/Resources/views/';
        $this->loadViewsFrom($views, 'metrique-building');

        view()->composer('*', BuildingViewComposer::class);
    }

    protected function registerComponent()
    {
        $this->app->bind(
            ComponentRepositoryInterface::class,
            ComponentRepositoryEloquent::class
        );
    }

    protected function registerComponentType()
    {
        $this->app->bind(
            TypeRepositoryInterface::class,
            TypeRepositoryEloquent::class
        );
    }

    protected function registerComponentStructure()
    {
        $this->app->bind(
            StructureRepositoryInterface::class,
            StructureRepositoryEloquent::class
        );
    }

    protected function registerPage()
    {
        $this->app->bind(
            PageRepositoryInterface::class,
            PageRepositoryEloquent::class
        );
    }
    protected function registerPageContent()
    {
        $this->app->bind(
            ContentRepositoryInterface::class,
            ContentRepositoryEloquent::class
        );
    }
    protected function registerPageSection()
    {
        $this->app->bind(
            SectionRepositoryInterface::class,
            SectionRepositoryEloquent::class
        );
    }
    protected function registerPageGroup()
    {
        $this->app->bind(
            GroupRepositoryInterface::class,
            GroupRepositoryEloquent::class
        );
    }

    /**
     * Register the artisan commands.
     */
    protected function registerCommands()
    {
        $this->app->singleton('command.metrique.building-seed', function ($app) {
            return new BuildingSeedsCommand();
        });
    }
}
