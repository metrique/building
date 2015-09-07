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
5. `php artisan vendor:publish` to publish the `config/building.php` config file to your application config directory.
6. `php artisan metrique:migrate-building` to install the migrations to the database/migrations in your application.

## Usage

- To do.
