<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_blocks', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->boolean('single_item')->default(0);
            $table->text('params');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_blocks');
    }
}
