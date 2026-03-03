<?php

namespace App\Services\AI;

use App\Exceptions\AI\AIConnectionException;
use App\Exceptions\AI\AIInvalidResponseException;
use App\Exceptions\AI\AIRateLimitException;
use Illuminate\Support\Facades\Http;

class OpenAICompatibleService implements AIServiceInterface
{
    public function __construct(
        private string $apiKey,
        private string $model,
        private string $baseUrl,
        private string $providerName = 'openai-compatible',
    ) {}

    /**
     * Generate a response using the OpenAI-compatible chat completions endpoint.
     */
    public function generate(string $systemPrompt, string $userInput): string
    {
        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post("{$this->baseUrl}/chat/completions", [
                    'model' => $this->model,
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user',   'content' => $userInput],
                    ],
                    'response_format' => ['type' => 'json_object'],
                ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            throw new AIConnectionException($this->providerName, $e->getMessage());
        }

        if ($response->status() === 429) {
            throw new AIRateLimitException($this->providerName);
        }

        if ($response->failed()) {
            $error = $response->json('error.message', 'Unknown error');
            throw new AIConnectionException($this->providerName, "HTTP {$response->status()}: {$error}");
        }

        $content = $response->json('choices.0.message.content');

        if (empty($content)) {
            throw new AIInvalidResponseException($this->providerName, 'Empty response content');
        }

        return $content;
    }

    /**
     * Test the connection to the provider with a lightweight request.
     *
     * @return array{success: bool, message: string, latency_ms: int}
     */
    public function testConnection(): array
    {
        $start = microtime(true);

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(15)
                ->post("{$this->baseUrl}/chat/completions", [
                    'model' => $this->model,
                    'messages' => [
                        ['role' => 'user', 'content' => 'Hi'],
                    ],
                    'max_tokens' => 5,
                ]);

            $latency = (int) ((microtime(true) - $start) * 1000);

            if ($response->status() === 429) {
                return [
                    'success' => false,
                    'message' => 'Rate limit exceeded (429)',
                    'latency_ms' => $latency,
                ];
            }

            if ($response->failed()) {
                $error = $response->json('error.message', 'Unknown error');

                return [
                    'success' => false,
                    'message' => "HTTP {$response->status()}: {$error}",
                    'latency_ms' => $latency,
                ];
            }

            return [
                'success' => true,
                'message' => "Connected ({$latency}ms)",
                'latency_ms' => $latency,
            ];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            $latency = (int) ((microtime(true) - $start) * 1000);

            return [
                'success' => false,
                'message' => "Connection failed: {$e->getMessage()}",
                'latency_ms' => $latency,
            ];
        } catch (\Exception $e) {
            $latency = (int) ((microtime(true) - $start) * 1000);

            return [
                'success' => false,
                'message' => "Error: {$e->getMessage()}",
                'latency_ms' => $latency,
            ];
        }
    }
}
