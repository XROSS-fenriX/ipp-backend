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
        Schema::table('users', function (Blueprint $table) {
            // Nullable UUID foreign keys positioned after account_status
            $table->uuid('school_id')->nullable()->after('account_status');
            $table->uuid('elective_id')->nullable()->after('school_id');

            // Foreign Key Constraints
            $table->foreign('school_id')
                ->references('school_id')
                ->on('schools')
                ->nullOnDelete();

            $table->foreign('elective_id')
                ->references('elective_id')
                ->on('electives')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['school_id']);
            $table->dropForeign(['elective_id']);

            // Drop columns
            $table->dropColumn(['school_id', 'elective_id']);
        });
    }
};
