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
                break;

            case 'image':
                return

                view('laravel-building::partial.input-image', [
                    'name' => $params['name'],
                    'label' => 'Image',
                    'resource' => resolve(Plonk::class)->resource($params['value'] ?? ''),
                    'value' => $params['value'] ?? '',
                ]);

            case 'plonk':
            // $plonk = new Plonk;
            // return $label . sprintf(
            //     '<div class="col-md-6">
            //         <plonk
            //             hash-input-name="%s"
            //             hash-input-value="%s"
            //             image-path="%s"
            //             preview-image-src="%s"
            //             ></plonk>
            //     </div>',
            //     $params['name'],
            //     htmlentities($params['value']),
            //     '/plonk',
            //     $params['value'] ? \CDNify::cdn().$plonk->findByHash($params['value'])->resource['smallest'] : ''
            // );
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
