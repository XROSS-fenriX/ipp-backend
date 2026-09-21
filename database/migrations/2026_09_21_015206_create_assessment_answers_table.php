<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_answers', function (Blueprint $table) {
            $table->uuid('answer_id')->primary();
            $table->integer('score')->nullable();
            $table->text('student_answer')->nullable();
            $table->foreignUuid('submission_id')->constrained(table: 'assessment_submissions', column: 'submission_id')->cascadeOnDelete();
            $table->foreignUuid('question_id')->constrained(table: 'assessment_questions', column: 'question_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_answers');
    }
};
