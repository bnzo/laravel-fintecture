<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentAttributesData extends Data
{
    public function __construct(
        public string $amount,
        public string $currency,
        public string|Optional|null $communication = null,
    ) {}
}
