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
        Schema::create('classroom_user', function (Blueprint $table) {
            $table->uuid('cu_id')->primary();
            $table->foreignUuid('user_id')->constrained(table: 'users', column: 'user_id')->cascadeOnDelete();
            $table->foreignUuid('classroom_id')->constrained(table: 'classrooms', column: 'classroom_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_user');
    }
};
