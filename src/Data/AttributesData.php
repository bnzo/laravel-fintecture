<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Enums\Currency;
use Illuminate\Support\Facades\App;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class AttributesData extends Data
{
    public function __construct(
        public string $amount,
        public string $communication,
        #[WithCast(EnumCast::class, Currency::class)]
        public string|Optional|null $redirectUri = null,
        public string|Optional|null $state = null,
        public ?Currency $currency = Currency::EUR,
        public ?string $language = null
    ) {
        $this->state = $state ?: Optional::create();
        $this->redirectUri = $redirectUri ?: Optional::create();
        $this->language = $language ?? App::getLocale();
    }
}
