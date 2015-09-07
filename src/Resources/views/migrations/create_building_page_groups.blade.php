<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingPageGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_page_groups', function(Blueprint $table) {

            $table->timestamps();
            $table->increments('id');
            $table->json('params');
            $table->boolean('published')->default(0);
            $table->integer('order')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_page_groups');
    }
}
