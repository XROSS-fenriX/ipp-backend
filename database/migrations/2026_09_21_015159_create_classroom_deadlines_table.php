<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom_deadlines', function (Blueprint $table) {
            $table->uuid('cd_id')->primary();
            $table->string('cd_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('deadline_type');
            $table->text('deadline_description')->nullable();
            $table->string('deadline_location')->nullable();
            $table->foreignUuid('classroom_id')->constrained(table: 'classrooms', column: 'classroom_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_deadlines');
    }
};
