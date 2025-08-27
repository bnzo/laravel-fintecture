<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Currency;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class PaymentAttributesData extends Data
{
    public function __construct(
        public string $amount,
        #[WithCast(EnumCast::class, Currency::class)]
        public string $communication,
        public ?Currency $currency = Currency::EUR,
    ) {}
}
