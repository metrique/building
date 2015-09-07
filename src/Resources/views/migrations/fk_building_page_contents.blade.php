<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingPageContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_page_contents', function(Blueprint $table) {
            
            $table->integer('building_pages_id')
                ->unsigned();

            $table->foreign('building_pages_id')
                ->references('id')
                ->on('building_pages')
                ->onDelete('cascade');

            $table->integer('building_page_sections_id')
                ->unsigned();

            $table->foreign('building_page_sections_id')
                ->references('id')
                ->on('building_page_sections')
                ->onDelete('cascade');

            $table->integer('building_page_groups_id')
                ->unsigned();

            $table->foreign('building_page_groups_id')
                ->references('id')
                ->on('building_page_groups')
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
