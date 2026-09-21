<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_questions', function (Blueprint $table) {
            $table->uuid('question_id')->primary();
            $table->text('question');
            $table->string('question_type');
            $table->integer('points')->default(0);
            $table->foreignUuid('assessment_id')->constrained(table: 'assessments', column: 'assessment_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_questions');
    }
};
