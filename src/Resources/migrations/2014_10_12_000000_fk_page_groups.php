<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkPageGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_groups', function (Blueprint $table) {
            $table->integer('page_contents_id')
                ->unsigned();

            $table->foreign('page_contents_id')
                ->references('id')
                ->on('page_contents')
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
            $table->dropForeign('page_contents_id');
        });
    }
}
