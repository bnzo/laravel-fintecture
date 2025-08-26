<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\PaymentStatus;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentResponseData extends Data
{
    public function __construct(
        public string|Optional|null $url,
        #[MapInputName('session_id')]
        public string|Optional|null $sessionId,
        #[WithCast(EnumCast::class, PaymentStatus::class)]
        public PaymentStatus|Optional|null $status,
    ) {}
}
