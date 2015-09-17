# laravel-building

A flexible page management system for Laravel 5.

## Installation

Add the following to the `repositories` section of your composer.json

```
"repositories": [
    {
        "url": "https://github.com/Metrique/laravel-building",
        "type": "git"
    }
],
```

1. Add `"Metrique/laravel-building": "dev-master"` to the require section of your composer.json.
2. Add `Metrique\Building\BuildingServiceProvider::class` to your list of service providers in `config/app.php`.
3. Add `'Building' => Metrique\Building\BuildingFacade::class` to your list of aliases in `config/app.php`.
4. `composer update`

### Config
You can publish the `config/building.php` config file to your application config directory by running `php artisan vendor:publish --tag="building-config"`

### Views
You can publish the views into `resource/vendor/building/` in your application by runnint `php artisan vendor:publish --tag=building-views`

### Migrations
Run `php artisan metrique:migrate-building` to install the migrations to the database/migrations in your application.

- To do.
