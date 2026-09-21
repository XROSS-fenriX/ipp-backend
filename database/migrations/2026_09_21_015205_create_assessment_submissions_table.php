<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_submissions', function (Blueprint $table) {
            $table->uuid('submission_id')->primary();
            $table->integer('score')->nullable();
            $table->foreignUuid('assessment_id')->constrained(table: 'assessments', column: 'assessment_id')->cascadeOnDelete();
            $table->string('student_lrn', 20);
            $table->foreign('student_lrn')->references('student_lrn')->on('student_details')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_submissions');
    }
};
