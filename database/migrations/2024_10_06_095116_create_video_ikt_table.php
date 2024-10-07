<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoIktTable extends Migration
{
    public function up()
    {
        Schema::create('video_ikt', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_link');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_ikt');
    }
}
