<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Display name, e.g. "Groq - Llama 4"
            $table->string('provider');                 // groq, gemini, openrouter, mistral
            $table->string('model');                    // e.g. llama-4, gemini-2.5-flash
            $table->text('api_key');                    // Encrypted via model $casts
            $table->string('base_url')->nullable();     // Null = use default constant
            $table->boolean('is_active')->default(false);
            $table->integer('priority')->default(0);    // Higher = tried first in fallback
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_providers');
    }
};
