<?php

namespace Metrique\Building\Database\Seeds;

use Metrique\Building\Eloquent\ComponentTypes;
use Illuminate\Database\Seeder;

class ComponentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'title' => 'Text',
            'slug' => 'text',
            'params' => '{}',
        ], [
            'title' => 'Text area',
            'slug' => 'text-area',
            'params' => '{}',
        ], [
            'title' => 'File',
            'slug' => 'file',
            'params' => '{}',
        ], [
            'title' => 'Widget',
            'slug' => 'widget',
            'params' => '{}',
        ])->each(function ($type) {
            ComponentType::create($type);
        });
    }
}
