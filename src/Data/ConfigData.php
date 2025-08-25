<?php

namespace Bnzo\Fintecture\Data;

use Bnzo\Fintecture\Casts\Base64PrivateKeyCast;
use Bnzo\Fintecture\Enums\Environment;
use Bnzo\Fintecture\Rules\Base64PrivateKeyRule;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class ConfigData extends Data
{
    public function __construct(
        #[MapInputName('app_id')]
        public string $appId,
        #[MapInputName('app_secret')]
        public string $appSecret,
        #[MapInputName('private_key')]
        #[WithCast(Base64PrivateKeyCast::class)]
        public string $privateKey,
        #[WithCast(EnumCast::class, Environment::class)]
        public Environment $environment = Environment::Sandbox,
    ) {}

    protected function rules(): array
    {
        return [
            'appId' => ['required', 'string', 'uuid'],
            'appSecret' => ['required', 'string', 'uuid'],
            'privateKey' => ['required', new Base64PrivateKeyRule],
            'environment' => ['string', 'in:sandbox,production'],
        ];
    }

    protected function casts(): array
    {
        return [
            'privateKey' => new Base64PrivateKeyCast,
            'environment' => new EnumCast(Environment::class),
        ];
    }
}
