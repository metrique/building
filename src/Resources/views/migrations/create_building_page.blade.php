<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_page', function(Blueprint $table) {

            $table->timestamps();
            $table->increments('id');
            $table->text('params');
            $table->integer('order')->unsigned()->default(0);
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_page');
    }
}
