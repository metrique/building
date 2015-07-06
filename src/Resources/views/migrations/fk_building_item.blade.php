<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_item', function(Blueprint $table) {

            $table->integer('building_index_id')
                ->unsigned();

            $table->foreign('building_index_id')
                ->references('id')
                ->on('building_index')
                ->onDelete('cascade');

            $table->integer('building_page_id')
                ->unsigned();

            $table->foreign('building_page_id')
                ->references('id')
                ->on('building_page')
                ->onDelete('cascade');

            $table->integer('building_group_id')
                ->unsigned();

            $table->foreign('building_group_id')
                ->references('id')
                ->on('building_group')
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
