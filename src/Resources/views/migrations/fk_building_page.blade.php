<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_page', function(Blueprint $table) {

            $table->integer('building_index_id')
                ->unsigned();

            $table->foreign('building_index_id')
                ->references('id')
                ->on('building_index')
                ->onDelete('cascade');
                  
            $table->integer('building_block_id')
                ->unsigned();

            $table->foreign('building_block_id')
                ->references('id')
                ->on('building_block')
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
