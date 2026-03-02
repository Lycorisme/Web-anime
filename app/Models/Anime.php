<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anime extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'title_english',
        'title_japanese',
        'type',
        'episodes',
        'status',
        'aired',
        'premiered',
        'studios',
        'source',
        'genres',
        'themes',
        'duration',
        'rating',
        'mal_score',
        'mal_url',
        'synopsis',
        'image_url',
        'personal_score',
        'watch_status',
        'notes',
        'watch_start_date',
        'watch_end_date',
    ];

    protected $casts = [
        'episodes' => 'integer',
        'mal_score' => 'decimal:2',
        'personal_score' => 'integer',
        'watch_start_date' => 'date',
        'watch_end_date' => 'date',
    ];

    /**
     * Get available anime types.
     */
    public static function getTypes(): array
    {
        return ['TV', 'Movie', 'OVA', 'ONA', 'Special', 'Music'];
    }

    /**
     * Get available watch statuses.
     */
    public static function getWatchStatuses(): array
    {
        return ['completed', 'watching', 'on_hold', 'dropped', 'plan_to_watch'];
    }

    /**
     * Get available airing statuses.
     */
    public static function getAiringStatuses(): array
    {
        return ['Finished Airing', 'Currently Airing', 'Not yet aired'];
    }
}
