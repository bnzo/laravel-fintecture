<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CustomerData extends Data
{
    public function __construct(
        public string $psu_email,
        public string $psu_name,
        public string|Optional|null $psu_company = null,
        public string|Optional|null $psu_form = null,
        public string|Optional|null $psu_incorporation = null,
        public string|Optional|null $psu_phone = null,
        public string|Optional|null $psu_phone_prefix = null,
        public string|Optional|null $psu_ip = null,
        public AddressData|Optional|null $psu_address = null,
    ) {
        $this->psu_company = $psu_company ?: Optional::create();
        $this->psu_form = $psu_form ?: Optional::create();
        $this->psu_incorporation = $psu_incorporation ?: Optional::create();
        $this->psu_phone = $psu_phone ?: Optional::create();
        $this->psu_phone_prefix = $psu_phone_prefix ?: Optional::create();
        $this->psu_ip = $psu_ip ?: Optional::create();
        $this->psu_address = $psu_address ?: Optional::create();
    }
}
