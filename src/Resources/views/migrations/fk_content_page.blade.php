<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkContentPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_page', function(Blueprint $table) {

            $table->integer('content_index_id')
                ->unsigned();

            $table->foreign('content_index_id')
                ->references('id')
                ->on('content_index')
                ->onDelete('cascade');
                  
            $table->integer('content_block_id')
                ->unsigned();

            $table->foreign('content_block_id')
                ->references('id')
                ->on('content_block')
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
