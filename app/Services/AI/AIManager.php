<?php

namespace App\Services\AI;

use App\Exceptions\AI\AIConnectionException;
use App\Exceptions\AI\AIRateLimitException;
use App\Models\AiProvider;
use Illuminate\Support\Facades\Log;

class AIManager
{
    /**
     * Send a prompt to the active AI provider with auto-fallback.
     */
    public function ask(string $systemPrompt, string $userInput): string
    {
        $providers = AiProvider::getActivesByPriority();

        if ($providers->isEmpty()) {
            throw new \RuntimeException('Tidak ada AI provider yang aktif. Aktifkan minimal satu provider di Settings → AI Providers.');
        }

        $lastError = null;

        foreach ($providers as $provider) {
            try {
                $service = $this->resolve($provider);

                return $service->generate($systemPrompt, $userInput);

            } catch (AIRateLimitException $e) {
                Log::warning("AI fallback: {$provider->name} rate limited", [
                    'provider' => $provider->provider,
                    'model' => $provider->model,
                ]);
                $lastError = $e;

                continue;

            } catch (AIConnectionException $e) {
                Log::warning("AI fallback: {$provider->name} connection failed", [
                    'provider' => $provider->provider,
                    'model' => $provider->model,
                    'error' => $e->getMessage(),
                ]);
                $lastError = $e;

                continue;
            }
            // Other exceptions (bugs, invalid response) are NOT caught — they bubble up
        }

        throw new \RuntimeException(
            'Semua AI provider gagal. Error terakhir: '.($lastError?->getMessage() ?? 'Unknown')
        );
    }

    /**
     * Test a specific provider's connection.
     *
     * @return array{success: bool, message: string, latency_ms: int}
     */
    public function testProvider(AiProvider $provider): array
    {
        try {
            $service = $this->resolve($provider);

            return $service->testConnection();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => "Error: {$e->getMessage()}",
                'latency_ms' => 0,
            ];
        }
    }

    /**
     * Resolve a provider to its corresponding service instance.
     */
    public function resolve(AiProvider $provider): AIServiceInterface
    {
        if ($provider->provider === 'gemini') {
            return new GeminiService(
                apiKey: $provider->api_key,
                model: $provider->model,
            );
        }

        // All other providers use OpenAI-compatible endpoint
        return new OpenAICompatibleService(
            apiKey: $provider->api_key,
            model: $provider->model,
            baseUrl: $provider->getBaseUrl(),
            providerName: $provider->getProviderLabel(),
        );
    }
}
