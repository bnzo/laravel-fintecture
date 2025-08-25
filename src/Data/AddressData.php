<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class AddressData extends Data
{
    public function __construct(public string $street,
        public string|Optional|null $number,
        public string|Optional|null $complement,
        public string $city,
        public string $zip,
        public string $country) {}
}
