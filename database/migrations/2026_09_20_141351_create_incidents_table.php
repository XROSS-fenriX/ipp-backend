<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->uuid('incident_id')->primary();
            $table->string('type');
            $table->string('intensity');
            $table->boolean('is_actioned')->default(false);
            $table->text('description')->nullable();
            $table->foreignUuid('caused_by')->nullable()->constrained(table: 'users', column: 'user_id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
