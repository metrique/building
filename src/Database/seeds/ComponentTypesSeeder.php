<?php

namespace Metrique\Building\Database\Seeds;

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
        $componentTypes = [
            [
                // 1
                'title'=>'Text',
                'slug'=>'input-text',
                'params'=>'{}',
            ],[
                // 2
                'title'=>'Text area',
                'slug'=>'text-area',
                'params'=>'{}',
            ],[
                // 3
                'title'=>'File',
                'slug'=>'file',
                'params'=>'{}',
            ],[
                // 4
                'title'=>'Widget',
                'slug'=>'widget',
                'params'=>'{}',
            ]
        ];

        foreach ($componentTypes as $key => $value) {
            \DB::table('component_types')->insert($value);
        }
    }
}
