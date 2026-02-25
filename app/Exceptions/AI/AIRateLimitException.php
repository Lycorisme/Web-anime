<?php

namespace App\Exceptions\AI;

use RuntimeException;

class AIRateLimitException extends RuntimeException
{
    public function __construct(string $provider = '', int $code = 429)
    {
        parent::__construct("Rate limit exceeded for AI provider: {$provider}", $code);
    }
}
