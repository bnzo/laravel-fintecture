<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Currency;
use Illuminate\Support\Facades\App;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class AttributesData extends Data
{
    public function __construct(
        public string $amount,
        public string $communication,
        #[WithCast(EnumCast::class, Currency::class)]
        public ?Currency $currency = Currency::EUR,
        public ?string $language = null
    ) {
        $this->language = $language ?? App::getLocale();
    }
}
