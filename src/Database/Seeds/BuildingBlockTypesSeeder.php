<?php

namespace Metrique\Building\Database\Seeds;

use Illuminate\Database\Seeder;

class BuildingBlockTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blockTypes = [
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
            ]
        ];

        foreach ($blockTypes as $key => $value) {
            \DB::table('building_block_types')->insert($value);
        }
    }
}
