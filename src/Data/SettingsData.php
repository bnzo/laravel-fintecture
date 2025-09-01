<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Method;
use Bnzo\Fintecture\Enums\ScheduledExpirationPolicy;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SettingsData extends Data
{
    public function __construct(
        public int $due_date = 86400,
        public int $expiry = 86400,
        #[WithCast(EnumCast::class, Method::class)]
        public Method $method = Method::Link,
        public bool $permanent = false,
        public string|Optional|null $redirectUri = null,
        #[WithCast(EnumCast::class, ScheduledExpirationPolicy::class)]
        public ScheduledExpirationPolicy $scheduled_expiration_policy = ScheduledExpirationPolicy::Immediate,
    ) {
        $this->permanent = $permanent ?: false;
        $this->redirectUri = $redirectUri ?: Optional::create();
    }
}
