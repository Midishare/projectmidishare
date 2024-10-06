<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenmdpTable extends Migration
{
    public function up()
    {
        Schema::create('dp', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Judul dokumen
            $table->string('image_path'); // Jalur gambar dokumen
            $table->string('link'); // Tautan dokumen
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('dp');
    }
}
