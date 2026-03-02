<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            
            // MAL Data Fields
            $table->string('title');
            $table->string('title_japanese')->nullable();
            $table->string('type')->default('TV'); // TV, Movie, OVA, ONA, Special, Music
            $table->integer('episodes')->nullable();
            $table->string('status')->nullable(); // Finished Airing, Currently Airing, Not yet aired
            $table->string('aired')->nullable();
            $table->string('premiered')->nullable(); // e.g. Fall 2013
            $table->string('studios')->nullable();
            $table->string('source')->nullable(); // Light novel, Manga, Original, etc.
            $table->string('genres')->nullable();
            $table->string('themes')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable(); // PG-13, R, etc.
            $table->decimal('mal_score', 4, 2)->nullable();
            $table->string('mal_url')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('image_url')->nullable();
            
            // Personal Tracking Fields
            $table->integer('personal_score')->nullable(); // 1-10
            $table->string('watch_status')->default('completed'); // completed, watching, dropped, plan_to_watch, on_hold
            $table->text('notes')->nullable();
            $table->date('watched_date')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
