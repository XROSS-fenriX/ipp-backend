<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom_announcements', function (Blueprint $table) {
            $table->uuid('ca_id')->primary();
            $table->string('ca_title');
            $table->text('ca_description')->nullable();
            $table->string('file_link')->nullable();
            $table->foreignUuid('classroom_id')->constrained(table: 'classrooms', column: 'classroom_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_announcements');
    }
};
