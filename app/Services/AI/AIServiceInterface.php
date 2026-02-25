<?php

namespace App\Services\AI;

interface AIServiceInterface
{
    /**
     * Generate a response from the AI provider.
     */
    public function generate(string $systemPrompt, string $userInput): string;

    /**
     * Test the connection to the AI provider.
     *
     * @return array{success: bool, message: string, latency_ms: int}
     */
    public function testConnection(): array;
}
