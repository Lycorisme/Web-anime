<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiProvider extends Model
{
    protected $fillable = [
        'name',
        'provider',
        'model',
        'api_key',
        'base_url',
        'is_active',
        'priority',
    ];

    protected $casts = [
        'api_key' => 'encrypted',
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    /**
     * Default base URLs per provider (OpenAI-compatible endpoints).
     */
    public const DEFAULT_BASE_URLS = [
        'groq' => 'https://api.groq.com/openai/v1',
        'openrouter' => 'https://openrouter.ai/api/v1',
        'mistral' => 'https://api.mistral.ai/v1',
    ];

    /**
     * Available providers with their default models and metadata.
     */
    public const AVAILABLE_PROVIDERS = [
        'groq' => [
            'label' => 'Groq',
            'models' => [
                'llama-3.3-70b-versatile',
                'llama-3.1-8b-instant',
                'deepseek-r1-distill-llama-70b',
                'gemma2-9b-it',
            ],
        ],
        'gemini' => [
            'label' => 'Google Gemini',
            'models' => [
                'gemini-2.5-flash',
                'gemini-2.5-pro',
                'gemini-2.0-flash',
            ],
        ],
        'openrouter' => [
            'label' => 'OpenRouter',
            'models' => [
                'meta-llama/llama-4-maverick:free',
                'deepseek/deepseek-chat-v3-0324:free',
                'mistralai/mistral-small-3.1-24b-instruct:free',
                'google/gemini-2.0-flash-exp:free',
            ],
        ],
        'mistral' => [
            'label' => 'Mistral AI',
            'models' => [
                'mistral-small-latest',
                'mistral-medium-latest',
                'open-mistral-nemo',
            ],
        ],
    ];

    /**
     * Get the resolved base URL (custom or default).
     */
    public function getBaseUrl(): string
    {
        return $this->base_url ?? (self::DEFAULT_BASE_URLS[$this->provider] ?? '');
    }

    /**
     * Get the single active provider.
     */
    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
    }

    /**
     * Get all active providers ordered by priority (highest first) for fallback.
     */
    public static function getActivesByPriority()
    {
        return static::where('is_active', true)
            ->orderBy('priority', 'desc')
            ->get();
    }

    /**
     * Get the provider label for display.
     */
    public function getProviderLabel(): string
    {
        return self::AVAILABLE_PROVIDERS[$this->provider]['label'] ?? ucfirst($this->provider);
    }
}
