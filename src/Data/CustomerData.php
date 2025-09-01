<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CustomerData extends Data
{
    public function __construct(
        #[MapInputName('psu_email')]
        #[MapOutputName('psu_email')]
        public string $email,
        #[MapInputName('psu_name')]
        #[MapOutputName('psu_name')]
        public string $name,
        #[MapInputName('psu_company')]
        #[MapOutputName('psu_company')]
        public string|Optional|null $company = null,
        #[MapInputName('psu_form')]
        #[MapOutputName('psu_form')]
        public string|Optional|null $form = null,
        #[MapInputName('psu_incorporation')]
        #[MapOutputName('psu_incorporation')]
        public string|Optional|null $incorporation = null,
        #[MapInputName('psu_phone')]
        #[MapOutputName('psu_phone')]
        public string|Optional|null $phone = null,
        #[MapInputName('psu_phone_prefix')]
        #[MapOutputName('psu_phone_prefix')]
        public string|Optional|null $phone_prefix = null,
        #[MapInputName('psu_ip')]
        #[MapOutputName('psu_ip')]
        public string|Optional|null $ip = null,
        #[MapInputName('psu_address')]
        #[MapOutputName('psu_address')]
        public AddressData|Optional|null $address = null,
    ) {
        $this->company = $company ?: Optional::create();
        $this->form = $form ?: Optional::create();
        $this->incorporation = $incorporation ?: Optional::create();
        $this->phone = $phone ?: Optional::create();
        $this->phone_prefix = $phone_prefix ?: Optional::create();
        $this->ip = $ip ?: Optional::create();
        $this->address = $address ?: Optional::create();
    }
}
