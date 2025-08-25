<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Method;
use Bnzo\Fintecture\Enums\ScheduledExpirationPolicy;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class PaymentSettingsData extends Data
{
    public function __construct(
        public int $expiry = 86400,
        public int $due_date = 86400,
        public bool $permanent = false,
        #[WithCast(EnumCast::class, ScheduledExpirationPolicy::class)]
        public ScheduledExpirationPolicy $scheduled_expiration_policy = ScheduledExpirationPolicy::Immediate,
        #[WithCast(EnumCast::class, Method::class)]
        public Method $method = Method::Link,
    ) {
        $this->permanent = $permanent ?: false;
    }
}
