<?php

namespace Bnzo\Fintecture\Utils;

class PaymentSplitter
{
    public static function split(float $amount, int $parts): array
    {
        $totalCents = round($amount * 100);
        $baseCents = intdiv($totalCents, $parts);
        $remainder = $totalCents % $parts;

        $payments = [];
        for ($i = 0; $i < $parts; $i++) {
            $payments[] = ($baseCents + ($i < $remainder ? 1 : 0)) / 100;
        }

        return $payments;
    }
}
