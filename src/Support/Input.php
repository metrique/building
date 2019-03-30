<?php

namespace Metrique\Building\Support;

use Metrique\Plonk\Repositories\PlonkInterface as Plonk;

class Input
{
    public static function inputName(array $params)
    {
        return implode('--', array_merge([
            'structure_id' => '',
            'group_id' => 0,
            'content_id' => 0,
        ], $params));
    }

    public static function input(array $params)
    {
        switch ($params['type']) {
            case 'text-area':
                return view('laravel-building::partial.input-textarea', [
                    'name' => $params['name'] ?? '',
                    'label' => $params['label'] ?? '',
                    'value' => $params['value'] ?? '',
                ]);
                break;

            case 'checkbox':
                $checkboxValue = 'true';

                return view('laravel-building::partial.input-checkbox', [
                    'name' => $params['name'] ?? '',
                    'label' => $params['label'] ?? '',
                    'value' => $params['value'] ?? '',
                    'attributes' => [
                        'data-post-unchecked',
                    ]
                ]);
                break;

            case 'image':
                return view('laravel-building::partial.input-text', [
                    'name' => $params['name'] ?? '',
                    'label' => $params['label'] ?? '',
                    'value' => $params['value'] ?? '',
                ]);
                break;

            default:
                return view('laravel-building::partial.input-text', [
                    'name' => $params['name'] ?? '',
                    'label' => $params['label'] ?? '',
                    'value' => $params['value'] ?? '',
                ]);
                break;
        }
    }
}
