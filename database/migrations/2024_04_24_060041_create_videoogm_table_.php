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
        Schema::create('videoogm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judulvidogm')->nullable();
            $table->string('linkogm')->nullable();
            // $table->string('dokumenvideoogm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videoogm');
    }
};
