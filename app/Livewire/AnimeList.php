<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anime;
use App\Services\MalParserService;
use Illuminate\Support\Facades\Log;

class AnimeList extends Component
{
    use WithPagination;

    // Search & Filter
    public $search = '';
    public $filterType = '';
    public $filterWatchStatus = '';
    public $sortBy = 'updated_at';
    public $sortDirection = 'desc';
    public $perPage = 12;

    // Form fields
    public $animeId;
    public $title = '';
    public $title_english = '';
    public $title_japanese = '';
    public $type = 'TV';
    public $episodes = null;
    public $status = '';
    public $aired = '';
    public $premiered = '';
    public $studios = '';
    public $source = '';
    public $genres = '';
    public $themes = '';
    public $duration = '';
    public $rating = '';
    public $mal_score = null;
    public $mal_url = '';
    public $synopsis = '';
    public $image_url = '';
    public $official_site = '';
    public $personal_score = null;
    public $watch_status = 'completed';
    public $notes = '';
    public $watch_start_date = null;
    public $watch_end_date = null;

    // MAL Paste
    public $malRawText = '';

    // Modal state
    public $isEditing = false;

    // Bulk
    public $selectedAnime = [];
    public $selectAll = false;

    protected $queryString = ['search', 'filterType', 'filterWatchStatus'];

    public function getAnimesQuery()
    {
        $query = Anime::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('title_japanese', 'like', '%' . $this->search . '%')
                  ->orWhere('genres', 'like', '%' . $this->search . '%')
                  ->orWhere('studios', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterWatchStatus) {
            $query->where('watch_status', $this->filterWatchStatus);
        }

        $query->orderBy($this->sortBy, $this->sortDirection);

        return $query;
    }

    public function render()
    {
        $animes = $this->getAnimesQuery()->paginate($this->perPage);

        return view('livewire.anime-list', [
            'animes' => $animes,
            'types' => Anime::getTypes(),
            'watchStatuses' => Anime::getWatchStatuses(),
        ])->layout('layouts.app');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterWatchStatus()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditing = false;
        $this->dispatch('open-anime-modal');
    }

    public function parseFromMAL()
    {
        if (empty($this->malRawText)) {
            $this->dispatch('toast-error', title: __('error'), message: __('paste_mal_text_first'));
            return;
        }

        try {
            $parser = new MalParserService();
            $parsed = $parser->parse($this->malRawText);

            // Fill form fields from parsed data
            $this->title = $parsed['title'] ?? $this->title;
            $this->title_english = $parsed['title_english'] ?? '';
            $this->title_japanese = $parsed['title_japanese'] ?? '';
            $this->type = $parsed['type'] ?? 'TV';
            $this->episodes = $parsed['episodes'] ?? null;
            $this->status = $parsed['status'] ?? '';
            $this->aired = $parsed['aired'] ?? '';
            $this->premiered = $parsed['premiered'] ?? '';
            $this->studios = $parsed['studios'] ?? '';
            $this->source = $parsed['source'] ?? '';
            $this->genres = $parsed['genres'] ?? '';
            $this->themes = $parsed['themes'] ?? '';
            $this->duration = $parsed['duration'] ?? '';
            $this->rating = $parsed['rating'] ?? '';
            $this->mal_score = $parsed['mal_score'] ?? null;
            $this->mal_url = $parsed['mal_url'] ?? '';
            $this->synopsis = $parsed['synopsis'] ?? '';
            $this->image_url = $parsed['image_url'] ?? '';

            $this->dispatch('toast-success', title: __('success'), message: __('mal_parsed_successfully'));
            $this->dispatch('mal-parsed');
        } catch (\Exception $e) {
            Log::error('MAL Parse Error: ' . $e->getMessage());
            $this->dispatch('toast-error', title: __('error'), message: __('mal_parse_failed'));
        }
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'watch_status' => 'required|string',
            'personal_score' => 'nullable|integer|min:1|max:10',
            'episodes' => 'nullable|integer|min:0',
            'mal_score' => 'nullable|numeric|min:0|max:10',
        ]);

        try {
            Anime::create([
                'title' => $this->title,
                'title_english' => $this->title_english,
                'title_japanese' => $this->title_japanese,
                'type' => $this->type,
                'episodes' => $this->episodes,
                'status' => $this->status,
                'aired' => $this->aired,
                'premiered' => $this->premiered,
                'studios' => $this->studios,
                'source' => $this->source,
                'genres' => $this->genres,
                'themes' => $this->themes,
                'duration' => $this->duration,
                'rating' => $this->rating,
                'mal_score' => $this->mal_score,
                'mal_url' => $this->mal_url,
                'synopsis' => $this->synopsis,
                'image_url' => $this->image_url,
                'official_site' => $this->official_site,
                'personal_score' => $this->personal_score,
                'watch_status' => $this->watch_status,
                'notes' => $this->notes,
                'watch_start_date' => $this->watch_start_date,
                'watch_end_date' => $this->watch_end_date,
            ]);

            $this->dispatch('close-anime-modal');
            $this->dispatch('toast-success', title: __('success'), message: __('anime_added'));
            $this->resetInputFields();
        } catch (\Exception $e) {
            Log::error('Anime Store Error: ' . $e->getMessage());
            $this->dispatch('toast-error', title: __('error'), message: $e->getMessage());
        }
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        
        $this->animeId = $anime->id;
        $this->title = $anime->title;
        $this->title_english = $anime->title_english;
        $this->title_japanese = $anime->title_japanese;
        $this->type = $anime->type;
        $this->episodes = $anime->episodes;
        $this->status = $anime->status;
        $this->aired = $anime->aired;
        $this->premiered = $anime->premiered;
        $this->studios = $anime->studios;
        $this->source = $anime->source;
        $this->genres = $anime->genres;
        $this->themes = $anime->themes;
        $this->duration = $anime->duration;
        $this->rating = $anime->rating;
        $this->mal_score = $anime->mal_score;
        $this->mal_url = $anime->mal_url;
        $this->synopsis = $anime->synopsis;
        $this->image_url = $anime->image_url;
        $this->official_site = $anime->official_site;
        $this->personal_score = $anime->personal_score;
        $this->watch_status = $anime->watch_status;
        $this->notes = $anime->notes;
        $this->watch_start_date = $anime->watch_start_date?->format('Y-m-d');
        $this->watch_end_date = $anime->watch_end_date?->format('Y-m-d');

        $this->isEditing = true;
        $this->dispatch('open-anime-modal');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'watch_status' => 'required|string',
            'personal_score' => 'nullable|integer|min:1|max:10',
            'episodes' => 'nullable|integer|min:0',
            'mal_score' => 'nullable|numeric|min:0|max:10',
        ]);

        try {
            $anime = Anime::findOrFail($this->animeId);
            $anime->update([
                'title' => $this->title,
                'title_english' => $this->title_english,
                'title_japanese' => $this->title_japanese,
                'type' => $this->type,
                'episodes' => $this->episodes,
                'status' => $this->status,
                'aired' => $this->aired,
                'premiered' => $this->premiered,
                'studios' => $this->studios,
                'source' => $this->source,
                'genres' => $this->genres,
                'themes' => $this->themes,
                'duration' => $this->duration,
                'rating' => $this->rating,
                'mal_score' => $this->mal_score,
                'mal_url' => $this->mal_url,
                'synopsis' => $this->synopsis,
                'image_url' => $this->image_url,
                'official_site' => $this->official_site,
                'personal_score' => $this->personal_score,
                'watch_status' => $this->watch_status,
                'notes' => $this->notes,
                'watch_start_date' => $this->watch_start_date,
                'watch_end_date' => $this->watch_end_date,
            ]);

            $this->dispatch('close-anime-modal');
            $this->dispatch('toast-success', title: __('success'), message: __('anime_updated'));
            $this->resetInputFields();
        } catch (\Exception $e) {
            Log::error('Anime Update Error: ' . $e->getMessage());
            $this->dispatch('toast-error', title: __('error'), message: $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Anime::findOrFail($id)->delete();
            $this->dispatch('toast-success', title: __('success'), message: __('anime_deleted'));
        } catch (\Exception $e) {
            Log::error('Anime Delete Error: ' . $e->getMessage());
            $this->dispatch('toast-error', title: __('error'), message: $e->getMessage());
        }
    }

    public function bulkDelete()
    {
        if (empty($this->selectedAnime)) return;

        try {
            Anime::whereIn('id', $this->selectedAnime)->delete();
            $count = count($this->selectedAnime);
            $this->selectedAnime = [];
            $this->selectAll = false;
            $this->dispatch('toast-success', title: __('success'), message: $count . ' ' . __('animes_deleted'));
        } catch (\Exception $e) {
            Log::error('Anime Bulk Delete Error: ' . $e->getMessage());
            $this->dispatch('toast-error', title: __('error'), message: $e->getMessage());
        }
    }

    public function resetInputFields()
    {
        $this->animeId = null;
        $this->title = '';
        $this->title_english = '';
        $this->title_japanese = '';
        $this->type = 'TV';
        $this->episodes = null;
        $this->status = '';
        $this->aired = '';
        $this->premiered = '';
        $this->studios = '';
        $this->source = '';
        $this->genres = '';
        $this->themes = '';
        $this->duration = '';
        $this->rating = '';
        $this->mal_score = null;
        $this->mal_url = '';
        $this->synopsis = '';
        $this->image_url = '';
        $this->official_site = '';
        $this->personal_score = null;
        $this->watch_status = 'completed';
        $this->notes = '';
        $this->watch_start_date = null;
        $this->watch_end_date = null;
        $this->malRawText = '';
        $this->isEditing = false;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedAnime = $this->getAnimesQuery()
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedAnime = [];
        }
    }
}
