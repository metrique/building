<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkContentIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_index', function(Blueprint $table) {

            $table->integer('content_index_id')
                ->unsigned()
                ->nullable();
                
            $table->foreign('content_index_id')
                ->references('id')
                ->on('content_index')
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
