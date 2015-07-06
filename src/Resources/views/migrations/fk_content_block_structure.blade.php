<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkContentBlockStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_block_structure', function(Blueprint $table) {

            $table->integer('content_block_id')
                ->unsigned();

            $table->foreign('content_block_id')
                ->references('id')
                ->on('content_block')
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
