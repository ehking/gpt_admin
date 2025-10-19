<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_data_source', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_definition_id')->constrained('form_definitions')->cascadeOnDelete();
            $table->foreignId('data_source_id')->constrained()->cascadeOnDelete();
            $table->json('mapping')->nullable();
            $table->timestamps();
            $table->unique(['form_definition_id', 'data_source_id'], 'form_data_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_data_source');
    }
};
