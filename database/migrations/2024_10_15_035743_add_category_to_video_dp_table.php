<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryTovideodpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_dp', function (Blueprint $table) {
            $table->string('category')->after('link'); // Tambahkan kolom category setelah kolom link
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_dp', function (Blueprint $table) {
            $table->dropColumn('category'); // Hapus kolom category saat rollback
        });
    }
}
