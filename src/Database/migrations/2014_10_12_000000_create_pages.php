<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('title', 191);
            $table->string('description', 191);
            $table->string('slug', 191)->unique();
            $table->text('params');
            $table->text('meta');
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
        Schema::drop('pages');
    }
}
