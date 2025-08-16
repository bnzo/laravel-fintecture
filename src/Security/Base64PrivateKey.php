<?php

namespace Bnzo\Fintecture\Security;

use InvalidArgumentException;

class Base64PrivateKey
{
    protected string $encoded;

    protected string $decoded;

    /**
     * Construct and validate.
     */
    public function __construct(string $encoded)
    {
        if (! self::isValid($encoded)) {
            throw new InvalidArgumentException('Invalid base64-encoded private key.');
        }

        $this->encoded = $encoded;
        $this->decoded = base64_decode($encoded, true);
    }

    /**
     * Check if a string is a valid base64 private key.
     */
    public static function isValid(string $encoded): bool
    {
        if (base64_encode(base64_decode($encoded, true)) !== $encoded) {
            return false;
        }

        $decoded = base64_decode($encoded, true);

        if (! str_contains($decoded, '-----BEGIN PRIVATE KEY-----') ||
            ! str_contains($decoded, '-----END PRIVATE KEY-----')) {
            return false;
        }

        $keyResource = @openssl_pkey_get_private($decoded);
        if ($keyResource === false) {
            return false;
        }

        return true;
    }

    /**
     * Return decoded PEM private key.
     */
    public function decoded(): string
    {
        return $this->decoded;
    }

    /**
     * Return base64-encoded private key (as given).
     */
    public function encoded(): string
    {
        return $this->encoded;
    }
}
