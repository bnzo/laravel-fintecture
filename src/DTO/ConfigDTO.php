<?php

namespace Bnzo\Fintecture\DTO;

use Bnzo\Fintecture\Casts\Base64PrivateKeyCast;
use Bnzo\Fintecture\Enums\Environment;
use Bnzo\Fintecture\Rules\Base64PrivateKeyRule;
use WendellAdriel\ValidatedDTO\Attributes\Map;
use WendellAdriel\ValidatedDTO\Casting\EnumCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ConfigDTO extends ValidatedDTO
{
    #[Map(data: 'app_id')]
    public string $appId;

    #[Map(data: 'app_secret')]
    public string $appSecret;

    #[Map(data: 'private_key')]
    public string $privateKey;

    public Environment $environment;

    protected function rules(): array
    {
        return [
            'appId' => ['required', 'string', 'uuid'],
            'appSecret' => ['required', 'string', 'uuid'],
            'appSecret' => ['required', 'string', 'uuid'],
            'privateKey' => ['required', new Base64PrivateKeyRule],
            'environment' => ['string', 'in:sandbox,production'],
        ];
    }

    protected function defaults(): array
    {
        return [
            'environment' => Environment::Sandbox,
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
