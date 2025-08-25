<?php

namespace Bnzo\Fintecture\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentAttributesDTO extends Data
{
    public function __construct(
        public string $amount,
        public string $currency,
        public string|Optional|null $communication = null,
    ) {}
}
