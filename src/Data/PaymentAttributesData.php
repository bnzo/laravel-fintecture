<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Currency;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentAttributesData extends Data
{
    public function __construct(
        public string $amount,
        #[WithCast(EnumCast::class, Currency::class)]
        public ?Currency $currency = Currency::EUR,
        public string|Optional|null $communication = null,
    ) {
        $this->communication = $communication ?: Optional::create();
    }
}
