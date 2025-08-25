<?php

namespace Bnzo\Fintecture\DTO;

use Bnzo\Fintecture\Enums\Method;
use Bnzo\Fintecture\Enums\ScheduledExpirationPolicy;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class PaymentSettingsDTO extends Data
{
    public function __construct(
        public ?bool $permanent,
        public int $expiry = 84000,
        public int $due_date = 84000,
        #[WithCast(EnumCast::class)]
        public ScheduledExpirationPolicy $scheduled_expiration_policy = ScheduledExpirationPolicy::Immediate,
        #[WithCast(EnumCast::class)]
        public Method $method = Method::Link,
    ) {
        $this->permanent = $permanent ?: false;
    }
}
