<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repositorykmogm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judulrepoogm')->nullable();
            $table->string('gambarrepoogm')->nullable();
            $table->string('dokumenfilerepoogm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositorykmogm_table_');
    }
};
