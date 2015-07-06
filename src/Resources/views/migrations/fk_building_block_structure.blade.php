<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingBlockStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_block_structure', function(Blueprint $table) {

            $table->integer('building_block_id')
                ->unsigned();

            $table->foreign('building_block_id')
                ->references('id')
                ->on('building_block')
                ->onDelete('cascade');

            $table->integer('building_block_type_id')
                ->unsigned();

            $table->foreign('building_block_type_id')
                ->references('id')
                ->on('building_block_type')
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
