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
        Schema::create('assessment_classroom', function (Blueprint $table) {
            $table->foreignUuid('classroom_id')->constrained(table: 'classrooms', column: 'classroom_id')->cascadeOnDelete();
            $table->foreignUuid('assessment_id')->constrained(table: 'assessments', column: 'assessment_id')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['assessment_id', 'classroom_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_classroom');
    }
};
