<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentCustomerData extends Data
{
    public function __construct(
        public string $psu_email,
        public string $psu_name,
        public string|Optional|null $psu_company,
        public string|Optional|null $psu_form,
        public string|Optional|null $psu_incorporation,
        public string|Optional|null $psu_phone,
        public string|Optional|null $psu_phone_prefix,
        public string|Optional|null $psu_ip,
        public AddressData|Optional|null $psu_address,
    ) {}
}
