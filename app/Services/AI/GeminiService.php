<?php

namespace App\Services\AI;

use App\Exceptions\AI\AIConnectionException;
use App\Exceptions\AI\AIRateLimitException;
use App\Exceptions\AI\AIInvalidResponseException;
use Illuminate\Support\Facades\Http;

class GeminiService implements AIServiceInterface
{
    private string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models';

    public function __construct(
        private string $apiKey,
        private string $model,
    ) {}

    /**
     * Generate a response using the Gemini API.
     */
    public function generate(string $systemPrompt, string $userInput): string
    {
        $url = "{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}";

        try {
            $response = Http::timeout(30)
                ->post($url, [
                    'system_instruction' => [
                        'parts' => [['text' => $systemPrompt]],
                    ],
                    'contents' => [[
                        'parts' => [['text' => $userInput]],
                    ]],
                    'generationConfig' => [
                        'response_mime_type' => 'application/json',
                    ],
                ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            throw new AIConnectionException('Gemini', $e->getMessage());
        }

        if ($response->status() === 429) {
            throw new AIRateLimitException('Gemini');
        }

        if ($response->failed()) {
            $error = $response->json('error.message', 'Unknown error');
            throw new AIConnectionException('Gemini', "HTTP {$response->status()}: {$error}");
        }

        $content = $response->json('candidates.0.content.parts.0.text');

        if (empty($content)) {
            throw new AIInvalidResponseException('Gemini', 'Empty response content');
        }

        return $content;
    }

    /**
     * Test the connection to Google Gemini with a lightweight request.
     *
     * @return array{success: bool, message: string, latency_ms: int}
     */
    public function testConnection(): array
    {
        $url = "{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}";
        $start = microtime(true);

        try {
            $response = Http::timeout(15)
                ->post($url, [
                    'contents' => [[
                        'parts' => [['text' => 'Hi']],
                    ]],
                    'generationConfig' => [
                        'maxOutputTokens' => 5,
                    ],
                ]);

            $latency = (int) ((microtime(true) - $start) * 1000);

            if ($response->status() === 429) {
                return [
                    'success'    => false,
                    'message'    => "Rate limit exceeded (429)",
                    'latency_ms' => $latency,
                ];
            }

            if ($response->failed()) {
                $error = $response->json('error.message', 'Unknown error');
                return [
                    'success'    => false,
                    'message'    => "HTTP {$response->status()}: {$error}",
                    'latency_ms' => $latency,
                ];
            }

            return [
                'success'    => true,
                'message'    => "Connected ({$latency}ms)",
                'latency_ms' => $latency,
            ];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            $latency = (int) ((microtime(true) - $start) * 1000);
            return [
                'success'    => false,
                'message'    => "Connection failed: {$e->getMessage()}",
                'latency_ms' => $latency,
            ];
        } catch (\Exception $e) {
            $latency = (int) ((microtime(true) - $start) * 1000);
            return [
                'success'    => false,
                'message'    => "Error: {$e->getMessage()}",
                'latency_ms' => $latency,
            ];
        }
    }
}
