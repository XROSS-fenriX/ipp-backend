<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_events', function (Blueprint $table) {
            $table->uuid('event_id')->primary();
            $table->string('event_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('event_scope');
            $table->string('event_type');
            $table->text('event_description')->nullable();
            $table->string('event_location')->nullable();
            $table->string('color_tag')->nullable();
            $table->foreignUuid('school_id')->constrained(table: 'schools', column: 'school_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_events');
    }
};
