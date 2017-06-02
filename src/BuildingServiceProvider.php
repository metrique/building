<?php

namespace Metrique\Building;

use Collective\Html\HtmlServiceProvider;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Metrique\Building\Commands\BuildingSeedsCommand;

use DH\Eloquent\Page;

class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        $this->registerHook();
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

    protected function bootCommands()
    {
        $this->commands('command.metrique.building-seed');
    }

    protected function bootConfig()
    {
        $this->publishes([
            __DIR__.'/Resources/config/building.php' => config_path('building.php')
        ], 'laravel-building');

        $this->mergeConfigFrom(
            __DIR__.'/Resources/config/building.php',
            'building'
        );
    }

    protected function bootMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    protected function bootRoutes()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Routes/api.php';
            require __DIR__.'/Routes/web.php';
        }
    }

    protected function bootViews()
    {
        $views = __DIR__ . '/Resources/views/';
        $this->loadViewsFrom($views, 'laravel-building');

        $this->publishes([
            __DIR__.'/Resources/views' => resource_path('views/vendor/laravel-building'),
        ], 'laravel-building');

        view()->composer('*', \Metrique\Building\Http\Composers\BuildingViewComposer::class);
    }

    protected function registerHook()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\HookRepositoryInterface::class,
            \Metrique\Building\Repositories\HookRepository::class
        );
    }

    protected function registerComponent()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\ComponentRepositoryInterface::class,
            \Metrique\Building\Repositories\ComponentRepositoryEloquent::class
        );
    }

    protected function registerComponentType()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\Component\TypeRepositoryInterface::class,
            \Metrique\Building\Repositories\Component\TypeRepositoryEloquent::class
        );
    }

    protected function registerComponentStructure()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\Component\StructureRepositoryInterface::class,
            \Metrique\Building\Repositories\Component\StructureRepositoryEloquent::class
        );
    }

    protected function registerPage()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\PageRepositoryInterface::class,
            \Metrique\Building\Repositories\PageRepository::class
        );
    }
    protected function registerPageContent()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface::class,
            \Metrique\Building\Repositories\Page\ContentRepositoryEloquent::class
        );
    }
    protected function registerPageSection()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface::class,
            \Metrique\Building\Repositories\Page\SectionRepositoryEloquent::class
        );
    }
    protected function registerPageGroup()
    {
        $this->app->bind(
            \Metrique\Building\Repositories\Contracts\Page\GroupRepositoryInterface::class,
            \Metrique\Building\Repositories\Page\GroupRepositoryEloquent::class
        );
    }

    /**
     * Register the artisan commands.
     */
    protected function registerCommands()
    {
        $this->app->singleton('command.metrique.building-seed', function ($app) {
            return new \Metrique\Building\Http\Composers\BuildingSeedsCommand();
        });
    }
}
