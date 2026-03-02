<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->string('title_english')->nullable()->after('title_japanese');
            $table->string('official_site')->nullable()->after('image_url');
            $table->date('watch_start_date')->nullable()->after('watch_status');
            $table->date('watch_end_date')->nullable()->after('watch_start_date');
            $table->dropColumn('watched_date');
        });
    }

    public function down(): void
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->date('watched_date')->nullable()->after('watch_status');
            $table->dropColumn(['title_english', 'official_site', 'watch_start_date', 'watch_end_date']);
        });
    }
};
