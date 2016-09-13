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
3. `composer update`.
4. `php artisan migrate --tag="metrique-building"`.
5. `php artisan metrique:building-seed`.

### Config
You can publish the `config/metrique-building.php` config file to your application config directory by running `php artisan vendor:publish --tag="metrique-building"`

### Views
You can create your own views instead of using the laravel-building defaults by overriding the `$views` property in any controller.

### Migrations
laravel-building migrations will be automatically run when the `php artisan migrate` command is executed.

- To do.
