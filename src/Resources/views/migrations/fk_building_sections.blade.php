<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_sections', function(Blueprint $table) {
            
            $table->integer('building_pages_id')
                ->unsigned();

            $table->foreign('building_pages_id')
                ->references('id')
                ->on('building_pages')
                ->onDelete('cascade');

            $table->integer('building_blocks_id')
                ->unsigned();

            $table->foreign('building_blocks_id')
                ->references('id')
                ->on('building_blocks')
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
