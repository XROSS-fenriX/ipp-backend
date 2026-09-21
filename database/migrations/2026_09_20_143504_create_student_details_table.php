<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->string('student_lrn', 20)->primary();
            $table->string('guardian_contact')->nullable();
            $table->string('grade_level');
            $table->string('strand')->nullable();
            $table->foreignUuid('user_id')->constrained(table: 'users', column: 'user_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_details');
    }
};
