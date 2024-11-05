<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_unstructed_learning_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('ks')->default(0);
            $table->integer('bs')->default(0);
            $table->integer('webinar')->default(0);
            $table->integer('sme')->default(0);
            $table->integer('leaderstalk')->default(0);
            $table->integer('onlinecourse')->default(0);
            $table->integer('cop')->default(0);
            $table->integer('podcast')->default(0);
            $table->integer('jurnal')->default(0);
            $table->integer('forumdiskusi')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_unstructed_learning_checklists');
    }
};
