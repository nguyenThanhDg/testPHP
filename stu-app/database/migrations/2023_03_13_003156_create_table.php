<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('gender', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('class');
            $table->foreign('class')->references('id')->on('class');
            $table->unsignedBigInteger('gender');
            $table->foreign('gender')->references('id')->on('gender');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
        Schema::dropIfExists('class');
        Schema::dropIfExists('gender');
    }
}
