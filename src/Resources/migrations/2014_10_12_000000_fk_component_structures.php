<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkComponentStructures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('component_structures', function (Blueprint $table) {
            $table->integer('components_id')
                ->unsigned();

            $table->foreign('components_id')
                ->references('id')
                ->on('components')
                ->onDelete('cascade');

            $table->integer('component_types_id')
                ->unsigned();

            $table->foreign('component_types_id')
                ->references('id')
                ->on('component_types')
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
        Schema::table('page_contents', function (Blueprint $table) {
            $table->dropForeign(['components_id']);
            $table->dropForeign(['component_types_id']);
        });
    }
}
