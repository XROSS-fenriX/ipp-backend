<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('identification_answers', function (Blueprint $table) {
            $table->uuid('id_answer_id')->primary();
            $table->string('correct_answer');
            $table->foreignUuid('question_id')->constrained(table: 'assessment_questions', column: 'question_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identification_answers');
    }
};
