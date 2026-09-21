<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->uuid('teacher_id')->primary();
            $table->string('position');
            $table->string('specialization')->nullable();
            $table->foreignUuid('user_id')->constrained(table: 'users', column: 'user_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_details');
    }
};
