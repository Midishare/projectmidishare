<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenmdpTable extends Migration
{
    public function up()
    {
        Schema::create('dokumenmdp', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('link');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumenmdp');
    }
}
