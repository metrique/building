<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingBlockStructures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_block_structures', function(Blueprint $table) {

            $table->integer('building_blocks_id')
                ->unsigned();

            $table->foreign('building_blocks_id')
                ->references('id')
                ->on('building_blocks')
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
