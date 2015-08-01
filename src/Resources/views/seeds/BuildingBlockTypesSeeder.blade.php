<?php echo '<?php' ?>


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
            ],[
                // 2
                'title'=>'Text area',
                'slug'=>'text-area',
            ],[
                // 3
                'title'=>'Text editor',
                'slug'=>'text-editor',
            ],[
                // 4
                'title'=>'Rich text',
                'slug'=>'rich-text',
            ],[
                // 5
                'title'=>'File',
                'slug'=>'file',
            ]
        ];

        foreach ($blockTypes as $key => $value) {
            DB::table('building_block_types')->insert($value);
        }
    }
}
