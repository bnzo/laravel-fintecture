<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class PaymentResponseData extends Data
{
    public function __construct(

        public string $url,
        #[MapInputName('session_id')]
        public string $sessionId,
    ) {}
}
