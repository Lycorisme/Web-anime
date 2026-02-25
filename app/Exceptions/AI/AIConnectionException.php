<?php

namespace App\Exceptions\AI;

use RuntimeException;

class AIConnectionException extends RuntimeException
{
    public function __construct(string $provider = '', string $detail = '')
    {
        $message = "Connection failed for AI provider: {$provider}";
        if ($detail) {
            $message .= " — {$detail}";
        }
        parent::__construct($message);
    }
}
