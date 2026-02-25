<?php

namespace App\Exceptions\AI;

use RuntimeException;

class AIInvalidResponseException extends RuntimeException
{
    public function __construct(string $provider = '', string $detail = '')
    {
        $message = "Invalid response from AI provider: {$provider}";
        if ($detail) {
            $message .= " — {$detail}";
        }
        parent::__construct($message);
    }
}
