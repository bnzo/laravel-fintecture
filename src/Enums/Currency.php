<?php

namespace Bnzo\Fintecture\Enums;

enum Currency: string
{
    case EUR = 'EUR';
    case USD = 'USD';
    case GBP = 'GBP';
    case JPY = 'JPY';
    case CHF = 'CHF';
    case CAD = 'CAD';
    case AUD = 'AUD';
    case CNY = 'CNY';

    // Add more as needed, full ISO 4217 list is ~180 currencies.

    public function symbol(): string
    {
        return match ($this) {
            self::EUR => '€',
            self::USD => '$',
            self::GBP => '£',
            self::JPY => '¥',
            self::CHF => 'CHF',
            self::CAD => 'CA$',
            self::AUD => 'A$',
            self::CNY => '¥',
        };
    }

    public function numericCode(): int
    {
        return match ($this) {
            self::EUR => 978,
            self::USD => 840,
            self::GBP => 826,
            self::JPY => 392,
            self::CHF => 756,
            self::CAD => 124,
            self::AUD => 36,
            self::CNY => 156,
        };
    }
}
