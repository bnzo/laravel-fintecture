<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Method;
use Bnzo\Fintecture\Enums\ScheduledExpirationPolicy;
use Bnzo\Fintecture\Transformers\CarbonDiffInSecondsTransformer;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SettingsData extends Data
{
    public function __construct(
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i:s')]
        #[WithTransformer(CarbonDiffInSecondsTransformer::class)]
        #[MapInputName('due_date')]
        #[MapOutputName('due_date')]
        public ?Carbon $dueAt = null,
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i:s')]
        #[WithTransformer(CarbonDiffInSecondsTransformer::class)]
        #[MapInputName('expiry')]
        #[MapOutputName('expiry')]
        public ?Carbon $expiresAt = null,
        #[WithCast(EnumCast::class, Method::class)]
        public ?Method $method = Method::Link,
        public ?bool $permanent = false,
        public string|Optional|null $redirectUri = null,
        #[WithCast(EnumCast::class, ScheduledExpirationPolicy::class)]
        public ScheduledExpirationPolicy $scheduled_expiration_policy = ScheduledExpirationPolicy::Immediate,
    ) {
        $this->dueAt = $dueAt ?: now()->addHours(24);
        $this->expiresAt = $expiresAt ?: now()->addHours(24);
        $this->method = $method ?: Method::Link;
        $this->permanent = $permanent ?: false;
        $this->redirectUri = $redirectUri ?: Optional::create();
        $this->scheduled_expiration_policy = $scheduled_expiration_policy ?: ScheduledExpirationPolicy::Immediate;

    }
}
