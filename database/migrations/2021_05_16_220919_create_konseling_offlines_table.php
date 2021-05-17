<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonselingOfflinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konseling_offlines', function (Blueprint $table) {
            $table->id();
            $table->String('nama_konseli');
            $table->String('unit_asal_konseli');
            $table->String('tempat');
            $table->String('waktu');
            $table->String('topik');
            $table->String('rekam_konseling');
            $table->String('rumusan_masalah');
            $table->String('treatment');
            $table->unsignedBigInteger('konselor_id');
            $table->timestamps();
            $table->foreign('konselor_id')->references('id')->on('konselors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konseling_offlines');
    }
}
