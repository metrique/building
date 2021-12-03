# laravel-building

A flexible page management system for Laravel.

## Installation

1. `composer require metrique/building`
2. `php artisan vendor:publish --provider="Metrique\Building\BuildingServiceProvider" --tag="migrations"`
3. `php artisan vendor:publish --provider="Metrique\Building\BuildingServiceProvider" --tag="config"`

### Package development

```
"repositories": [
    {
        "type": "path",
        "url": "../building"
    }
]
```
