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
        Schema::create('class_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key ke tabel users
            $table->unsignedBigInteger('class_id');  // Foreign key ke tabel classes
            $table->unsignedBigInteger('added_by');  // Admin yang menambahkan user ke kelas
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Foreign key ke tabel classes
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            // Foreign key ke admin (dari tabel users)
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_users');
    }
};
