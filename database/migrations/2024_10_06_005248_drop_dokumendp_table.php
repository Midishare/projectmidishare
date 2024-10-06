<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDokumendpTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('dokumendp');
    }

    public function down()
    {
        // Jika ingin mengembalikan tabel, buat lagi di sini
        Schema::create('dokumendp', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('link');
            $table->timestamps();
        });
    }
}
