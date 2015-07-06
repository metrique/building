<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_index', function(Blueprint $table) {

            $table->integer('building_index_id')
                ->unsigned()
                ->nullable();
                
            $table->foreign('building_index_id')
                ->references('id')
                ->on('building_index')
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
