<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkBuildingComponentStructures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_component_structures', function (Blueprint $table) {
            $table->integer('building_components_id')
                ->unsigned();

            $table->foreign('building_components_id')
                ->references('id')
                ->on('building_components')
                ->onDelete('cascade');

            $table->integer('building_component_types_id')
                ->unsigned();

            $table->foreign('building_component_types_id')
                ->references('id')
                ->on('building_component_types')
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
            $table->dropForeign(['building_components_id']);
            $table->dropForeign(['building_component_types_id']);
        });
    }
}
