<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('electives', function (Blueprint $table) {
            $table->uuid('elective_id')->primary();
            $table->string('elective_name');
            $table->foreignUuid('track_id')->constrained(table: 'tracks', column: 'track_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('electives');
    }
};
