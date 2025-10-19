<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_data_source', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_definition_id')->constrained('report_definitions')->cascadeOnDelete();
            $table->foreignId('data_source_id')->constrained()->cascadeOnDelete();
            $table->json('mapping')->nullable();
            $table->timestamps();
            $table->unique(['report_definition_id', 'data_source_id'], 'report_data_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_data_source');
    }
};
