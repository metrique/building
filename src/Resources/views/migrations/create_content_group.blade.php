<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_group', function(Blueprint $table) {

            $table->timestamps();
            $table->increments('id');
            $table->text('params');
            $table->integer('order')->unsigned()->default(0);
            $table->integer('published')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_group');
    }
}
