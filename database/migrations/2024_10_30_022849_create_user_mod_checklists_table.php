<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModChecklistsTable extends Migration
{
    public function up()
    {
        Schema::create('user_mod_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('existing_grade_genap')->default(false);
            $table->boolean('ip')->default(false);
            $table->boolean('existing_grade_ganjil')->default(false);
            $table->boolean('mdp')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_mod_checklists');
    }
}
