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
        Schema::table('user_gap_knowledge_checklists', function (Blueprint $table) {
            $table->boolean('INT')->default(false);
            $table->boolean('INO')->default(false);
            $table->boolean('KST')->default(false);
            $table->boolean('OPP')->default(false);
            $table->boolean('KPT')->default(false);
            $table->boolean('PBB')->default(false);
            $table->boolean('PDP')->default(false);
            $table->boolean('MDM')->default(false);
            $table->boolean('MKP')->default(false);
            $table->boolean('KPP')->default(false);
            $table->boolean('APM')->default(false);
            $table->boolean('KEF')->default(false);
            $table->boolean('PNG')->default(false);
            $table->boolean('MHK')->default(false);
            $table->boolean('KPD')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gap_knowledge_checklists', function (Blueprint $table) {
            $table->dropColumn(['INT', 'INO', 'KST', 'OPP', 'KPT', 'PBB', 'PDP', 'MDM', 'MKP', 'KPP', 'APM', 'KEF', 'PNG', 'MHK', 'KPD']);
        });
    }
};
