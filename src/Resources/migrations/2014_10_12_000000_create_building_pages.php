<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_pages', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->text('params');
            $table->text('meta');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->boolean('published')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_pages');
    }
}
