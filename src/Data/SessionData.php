<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SessionData extends Data
{
    public function __construct(
        public string|Optional|null $url,
        #[MapInputName('session_id')]
        public string|Optional|null $sessionId,
    ) {}
}
