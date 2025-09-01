<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SessionData extends Data
{
    public function __construct(
        public string|Optional|null $amount,
        #[MapInputName('customer_id')]
        public string|Optional|null $customerId,
        public string|Optional|null $event,
        public string|Optional|null $provider,
        #[MapInputName('session_id')]
        public string|Optional|null $sessionId,
        public string|Optional|null $state,
        public string|Optional|null $status,
        #[MapInputName('transfer_state')]
        public string|Optional|null $transferState,
        public string|Optional|null $type,
        public string|Optional|null $url,
    ) {}
}
