<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom_materials', function (Blueprint $table) {
            $table->uuid('cm_id')->primary();
            $table->string('title');
            $table->string('file_link');
            $table->text('description')->nullable();
            $table->foreignUuid('classroom_id')->constrained(table: 'classrooms', column: 'classroom_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_materials');
    }
};
