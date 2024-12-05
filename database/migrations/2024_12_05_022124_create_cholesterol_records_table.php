<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCholesterolRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('cholesterol_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_cholesterol', 5, 2);
            $table->decimal('ldl_cholesterol', 5, 2)->nullable();
            $table->decimal('hdl_cholesterol', 5, 2)->nullable();
            $table->decimal('triglycerides', 5, 2)->nullable();
            $table->string('result_status');
            $table->string('result_level');
            $table->string('result_risk');
            $table->timestamp('checked_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cholesterol_records');
    }
}
