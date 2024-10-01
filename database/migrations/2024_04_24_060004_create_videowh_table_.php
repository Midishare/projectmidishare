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
        Schema::create('videowh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judulvidwh')->nullable();
            $table->string('linkwh')->nullable();
            // $table->string('dokumenvideowh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videowh');
    }
};
