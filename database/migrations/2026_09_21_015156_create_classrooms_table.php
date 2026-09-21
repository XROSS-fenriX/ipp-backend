<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->uuid('classroom_id')->primary();
            $table->string('classroom_name');
            $table->string('subject_name');
            $table->string('grade_level');
            $table->foreignUuid('adviser_id')->nullable()->constrained(table: 'users', column: 'user_id')->nullOnDelete();
            $table->foreignUuid('elective_id')->nullable()->constrained(table: 'electives', column: 'elective_id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
