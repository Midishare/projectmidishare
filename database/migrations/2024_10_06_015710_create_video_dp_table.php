<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoDpTable extends Migration
{
    public function up()
    {
        Schema::create('video_dp', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');       // Menyimpan link jika diperlukan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_dp');
    }
}
