<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_block', function(Blueprint $table) {
            
            $table->timestamps();
            $table->increments('id');
            $table->text('params');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->integer('single_item')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_block');
    }
}
