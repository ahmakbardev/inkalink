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
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('skill_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('goal_id')->nullable()->after('skill_id');

            $table->foreign('skill_id')->references('id')->on('journal_entries')->onDelete('set null');
            $table->foreign('goal_id')->references('id')->on('journal_entries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['goal_id']);
            $table->dropColumn(['skill_id', 'goal_id']);
        });
    }
};
