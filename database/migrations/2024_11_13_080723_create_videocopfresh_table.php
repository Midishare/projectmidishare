<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideocopfreshTable extends Migration
{
    public function up()
    {
        Schema::create('videocopfresh', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_link');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('videocopfresh');
    }
}


// videocopfresh