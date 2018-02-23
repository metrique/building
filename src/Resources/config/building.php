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
        'prefix' => 'metrique-building',
        'ttl' => 5,
    ],
    'component' => [
        'view_path' => 'components.',
        'widget_path' => 'components.widgets',
    ],
    'prefix' => [
        'web' => 'building',
    ]
];
