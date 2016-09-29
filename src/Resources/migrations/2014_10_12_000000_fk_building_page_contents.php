<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingPageContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_page_contents', function (Blueprint $table) {
            $table->integer('building_pages_id')
                ->unsigned();

            $table->foreign('building_pages_id')
                ->references('id')
                ->on('building_pages')
                ->onDelete('cascade');

            $table->integer('building_page_sections_id')
                ->unsigned();

            $table->foreign('building_page_sections_id')
                ->references('id')
                ->on('building_page_sections')
                ->onDelete('cascade');

            $table->integer('building_page_groups_id')
                ->unsigned();

            $table->foreign('building_page_groups_id')
                ->references('id')
                ->on('building_page_groups')
                ->onDelete('cascade');

            $table->integer('building_component_structures_id')
                ->unsigned();

            $table->foreign('building_component_structures_id')
                ->references('id')
                ->on('building_component_structures')
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
        Schema::table('building_page_contents', function (Blueprint $table) {
            $table->dropForeign('building_pages_id');
            $table->dropForeign('building_page_sections_id');
            $table->dropForeign('building_page_groups_id');
            $table->dropForeign('building_component_structures_id');
            $table->dropForeign('building_component_types_id');
        });
    }
}
