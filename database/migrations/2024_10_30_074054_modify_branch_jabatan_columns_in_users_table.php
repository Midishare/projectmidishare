<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBranchJabatanColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing 'branch' column
            $table->dropColumn('branch');

            // Add the 'jabatan' column next to the 'nik' column
            $table->string('jabatan')->nullable()->after('nik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the 'jabatan' column
            $table->dropColumn('jabatan');

            // Add the 'branch' column back
            $table->string('branch')->nullable();
        });
    }
}
