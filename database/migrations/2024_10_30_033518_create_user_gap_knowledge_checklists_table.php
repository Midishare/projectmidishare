<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGapKnowledgeChecklistsTable extends Migration
{
    public function up()
    {
        Schema::create('user_gap_knowledge_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('OHK')->default(false);
            $table->boolean('BPA')->default(false);
            $table->boolean('MOM')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_gap_knowledge_checklists');
    }
}
