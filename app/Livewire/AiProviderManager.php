<?php

namespace App\Livewire;

use App\Models\AiProvider;
use App\Services\AI\AIManager;
use Livewire\Component;

class AiProviderManager extends Component
{
    // --- Provider list ---
    public $providers = [];

    public array $availableProviders = [];

    // --- Form fields (one per line) ---
    public string $aiName = '';

    public string $aiProvider = '';

    public string $aiModel = '';

    public string $aiApiKey = '';

    public string $aiBaseUrl = '';

    public int $aiPriority = 0;

    // --- Modal state ---
    public bool $showModal = false;

    public ?int $editingId = null;

    // --- Test connection state ---
    public bool $showTestModal = false;

    public ?int $testingId = null;

    public ?array $testResult = null;

    public function mount(): void
    {
        $this->loadProviders();
        $this->availableProviders = AiProvider::AVAILABLE_PROVIDERS;
    }

    public function loadProviders(): void
    {
        $this->providers = AiProvider::orderBy('priority', 'desc')->get();
    }

    // ─── Modal Actions ──────────────────────────────────────────

    public function openAddProvider(): void
    {
        $this->resetForm();
        $this->editingId = null;
        $this->showModal = true;
    }

    public function openEditProvider(int $id): void
    {
        $provider = AiProvider::findOrFail($id);

        $this->editingId = $provider->id;
        $this->aiName = $provider->name;
        $this->aiProvider = $provider->provider;
        $this->aiModel = $provider->model;
        $this->aiApiKey = ''; // Never pre-fill API key for security
        $this->aiBaseUrl = $provider->base_url ?? '';
        $this->aiPriority = $provider->priority;
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetErrorBag();
    }

    // ─── CRUD Operations ────────────────────────────────────────

    public function saveProvider(): void
    {
        $rules = [
            'aiName' => 'required|string|max:100',
            'aiProvider' => 'required|in:groq,gemini,openrouter,mistral',
            'aiModel' => 'required|string|max:100',
            'aiPriority' => 'required|integer|min:0|max:100',
            'aiBaseUrl' => 'nullable|url',
        ];

        // API key required for new providers, optional for editing
        if (! $this->editingId) {
            $rules['aiApiKey'] = 'required|string|min:10';
        } else {
            $rules['aiApiKey'] = 'nullable|string|min:10';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->aiName,
            'provider' => $this->aiProvider,
            'model' => $this->aiModel,
            'base_url' => $this->aiBaseUrl ?: null,
            'priority' => $this->aiPriority,
        ];

        // Only update API key if provided
        if ($this->aiApiKey) {
            $data['api_key'] = $this->aiApiKey;
        }

        if ($this->editingId) {
            AiProvider::findOrFail($this->editingId)->update($data);
            $message = __('provider_updated');
        } else {
            AiProvider::create($data);
            $message = __('provider_saved');
        }

        $this->closeModal();
        $this->loadProviders();

        $this->dispatch('toast-success', [
            'message' => $message,
            'title' => __('ai_providers').' ✅',
        ]);
    }

    public function deleteProvider(int $id): void
    {
        AiProvider::findOrFail($id)->delete();
        $this->loadProviders();

        $this->dispatch('toast-success', [
            'message' => __('provider_deleted'),
            'title' => __('ai_providers'),
        ]);
    }

    public function toggleActive(int $id): void
    {
        $provider = AiProvider::findOrFail($id);

        if ($provider->is_active) {
            // Deactivate
            $provider->update(['is_active' => false]);
            $message = $provider->name.' '.__('deactivated');
        } else {
            // Deactivate all others, activate this one
            AiProvider::where('is_active', true)->update(['is_active' => false]);
            $provider->update(['is_active' => true]);
            $message = $provider->name.' '.__('activated');
        }

        $this->loadProviders();

        $this->dispatch('toast-success', [
            'message' => $message,
            'title' => __('ai_providers'),
        ]);
    }

    // ─── Test Connection ────────────────────────────────────────

    public function openTestModal(int $id): void
    {
        $this->testResult = null;
        $this->testingId = $id;
        $this->showTestModal = true;
    }

    public function testConnection(int $id): void
    {
        $this->testingId = $id;
        $provider = AiProvider::findOrFail($id);
        $manager = app(AIManager::class);
        $result = $manager->testProvider($provider);

        $this->testResult = $result;
        $this->testingId = null;
    }

    // ─── Helpers ─────────────────────────────────────────────────

    private function resetForm(): void
    {
        $this->aiName = '';
        $this->aiProvider = '';
        $this->aiModel = '';
        $this->aiApiKey = '';
        $this->aiBaseUrl = '';
        $this->aiPriority = 0;
        $this->editingId = null;
    }

    /**
     * Get suggested models when provider changes (for dynamic UI).
     */
    public function updatedAiProvider(): void
    {
        $this->aiModel = '';
        $this->aiBaseUrl = '';

        // Auto-fill base URL default if not Gemini
        if ($this->aiProvider && $this->aiProvider !== 'gemini') {
            $this->aiBaseUrl = AiProvider::DEFAULT_BASE_URLS[$this->aiProvider] ?? '';
        }
    }

    public function render()
    {
        return view('livewire.ai-provider-manager');
    }
}
