<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Building settings.
    |--------------------------------------------------------------------------
    |
    | This is a list of settings for laravel-building.
    |
    */
    'cache' => [
        'ttl' => 5,
    ],
    'component' => [
        'view_path' => 'components.',
        'widget_path' => 'components.widgets',
    ],
    'prefix' => [
        'api' => 'building/api',
        'web' => 'building',
    ]
];
