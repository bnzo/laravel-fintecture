<?php

namespace Bnzo\Fintecture\Casts;

use Bnzo\Fintecture\Security\Base64PrivateKey;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class Base64PrivateKeyCast implements Cast
{
    /**
     * Transform the raw input into the desired value.
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if (! is_string($value)) {
            throw new \InvalidArgumentException("{$property->name} must be a base64-encoded string.");
        }

        try {
            // Delegate to your value object
            return (new Base64PrivateKey($value))->decoded();
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException("{$property->name} is not a valid base64-encoded private key.");
        }
    }
}
