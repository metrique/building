<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkContentItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_item', function(Blueprint $table) {

            $table->integer('content_index_id')
                ->unsigned();

            $table->foreign('content_index_id')
                ->references('id')
                ->on('content_index')
                ->onDelete('cascade');

            $table->integer('content_page_id')
                ->unsigned();

            $table->foreign('content_page_id')
                ->references('id')
                ->on('content_page')
                ->onDelete('cascade');

            $table->integer('content_group_id')
                ->unsigned();

            $table->foreign('content_group_id')
                ->references('id')
                ->on('content_group')
                ->onDelete('cascade');

            $table->integer('content_block_type_id')
                ->unsigned();

            $table->foreign('content_block_type_id')
                ->references('id')
                ->on('content_block_type')
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
