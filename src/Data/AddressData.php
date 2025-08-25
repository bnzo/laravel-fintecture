<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class AddressData extends Data
{
    public function __construct(
        public string $street,
        public string $zip,
        public string $city,
        public string $country,
        public string|Optional|null $number = null,
        public string|Optional|null $complement = null, ) {}
}
