<?php

namespace Bnzo\Fintecture\Rules;

use Bnzo\Fintecture\Security\Base64PrivateKey;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Base64PrivateKeyRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Base64PrivateKey::isValid($value)) {
            $fail("The {$attribute} must be a valid base64-encoded private key.");
        }
    }
}
