    <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingPageSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_page_sections', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->integer('order')->unsigned()->default(0);
            $table->text('params');
            $table->text('meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_page_sections');
    }
}
