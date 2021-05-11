<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('path')->unique();
            $table->string('name');
            $table->unsignedBigInteger('konseling_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('file_type');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('konseling_id')->references('id')->on('konselings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
