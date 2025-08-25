<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentCustomerData extends Data
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
    ) {}
}
