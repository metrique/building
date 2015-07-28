<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_contents', function(Blueprint $table) {
            
            $table->integer('building_pages_id')
                ->unsigned();

            $table->foreign('building_pages_id')
                ->references('id')
                ->on('building_pages')
                ->onDelete('cascade');

            $table->integer('building_sections_id')
                ->unsigned();

            $table->foreign('building_sections_id')
                ->references('id')
                ->on('building_sections')
                ->onDelete('cascade');

            $table->integer('building_groups_id')
                ->unsigned();

            $table->foreign('building_groups_id')
                ->references('id')
                ->on('building_groups')
                ->onDelete('cascade');

            $table->integer('building_block_types_id')
                ->unsigned();

            $table->foreign('building_block_types_id')
                ->references('id')
                ->on('building_block_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
