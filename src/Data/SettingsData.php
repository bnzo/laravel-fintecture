<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Method;
use Bnzo\Fintecture\Enums\ScheduledExpirationPolicy;
use Bnzo\Fintecture\Transformers\CarbonDiffInSecondsTransformer;
use DateTimeInterface;
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
        public DateTimeInterface|Optional|null $dueAt = null,
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i:s')]
        #[WithTransformer(CarbonDiffInSecondsTransformer::class)]
        #[MapInputName('expiry')]
        #[MapOutputName('expiry')]
        public DateTimeInterface|Optional|null $expiresAt = null,
        #[WithCast(EnumCast::class, Method::class)]
        public Method|Optional|null $method = null,
        public bool|Optional|null $permanent = null,
        public string|Optional|null $redirectUri = null,
        #[WithCast(EnumCast::class, ScheduledExpirationPolicy::class)]
        public ScheduledExpirationPolicy|Optional|null $scheduled_expiration_policy = null,
    ) {
        $this->dueAt = $dueAt ?: Optional::create();
        $this->expiresAt = $expiresAt ?: Optional::create();
        $this->method = $method ?: Optional::create();
        $this->permanent = $permanent ?: Optional::create();
        $this->redirectUri = $redirectUri ?: Optional::create();
        $this->scheduled_expiration_policy = $scheduled_expiration_policy ?: Optional::create();
    }
}
