<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mcq_choices', function (Blueprint $table) {
            $table->uuid('choice_id')->primary();
            $table->string('choice');
            $table->boolean('is_correct')->default(false);
            $table->foreignUuid('question_id')->constrained(table: 'assessment_questions', column: 'question_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mcq_choices');
    }
};
