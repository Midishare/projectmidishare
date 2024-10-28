<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryTovideoinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_ino', function (Blueprint $table) {
            $table->string('category')->after('video_link'); // Tambahkan kolom category setelah kolom link
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_ino', function (Blueprint $table) {
            $table->dropColumn('category'); // Hapus kolom category saat rollback
        });
    }
}
