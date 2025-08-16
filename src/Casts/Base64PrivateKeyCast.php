<?php

namespace Bnzo\Fintecture\Casts;

use Bnzo\Fintecture\Security\Base64PrivateKey;
use WendellAdriel\ValidatedDTO\Casting\Castable;
use WendellAdriel\ValidatedDTO\Exceptions\CastException;

class Base64PrivateKeyCast implements Castable
{
    public function cast(string $property, mixed $value): mixed
    {
        if (! is_string($value)) {
            throw new CastException("{$property} must be a base64-encoded string.");
        }

        try {
            // Delegate validation + decoding to your value object
            return (new Base64PrivateKey($value))->decoded();
        } catch (\Throwable $e) {
            throw new CastException("{$property} is not a valid base64-encoded private key.");
        }
    }
}
