<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasiBelajarTable extends Migration
{
    public function up()
    {
        Schema::create('rekomendasi_belajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID pengguna yang mendapat rekomendasi
            $table->text('rekomendasi'); // Isi rekomendasi belajar
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekomendasi_belajar');
    }
}
