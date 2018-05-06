<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkPageContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_contents', function (Blueprint $table) {
            $table->integer('pages_id')
                ->nullable()
                ->unsigned();

            $table->foreign('pages_id')
                ->references('id')
                ->on('pages')
                ->onDelete('cascade');

            $table->integer('page_sections_id')
                ->nullable()
                ->unsigned();

            $table->foreign('page_sections_id')
                ->references('id')
                ->on('page_sections')
                ->onDelete('cascade');

            $table->integer('page_groups_id')
                ->nullable()
                ->unsigned();

            $table->foreign('page_groups_id')
                ->references('id')
                ->on('page_groups')
                ->onDelete('cascade');

            $table->integer('component_structures_id')
                ->nullable()
                ->unsigned();

            $table->foreign('component_structures_id')
                ->references('id')
                ->on('component_structures')
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
            $table->dropForeign('page_contents_pages_id_foreign');
            $table->dropForeign('page_contents_page_sections_id_foreign');
            $table->dropForeign('page_contents_page_groups_id_foreign');
            $table->dropForeign('page_contents_component_structures_id_foreign');
        });
    }
}
