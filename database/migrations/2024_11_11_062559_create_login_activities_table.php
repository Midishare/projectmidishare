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
        Schema::create('login_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('ip_address')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['login', 'logout'])->default('login');
            $table->timestamp('login_at')->nullable();
            $table->timestamp('logout_at')->nullable();
            $table->integer('duration_minutes')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_activities');
    }
};
