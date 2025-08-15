<?php

namespace Bnzo\Fintecture\Utils;

class PaymentSplitter
{
    /**
     * Split an amount into N parts (default 3),
     * with the last part adjusted for rounding differences.
     */
    public static function split(float $amount, int $partsCount = 3): array
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        if ($partsCount <= 0) {
            throw new \InvalidArgumentException('Parts count must be greater than zero.');
        }

        // Convert to cents
        $totalCents = (int) round($amount * 100);

        // Compute first split in cents using ceil to make last split smaller
        $firstSplitCents = (int) ceil($totalCents / $partsCount);

        $splits = array_fill(0, $partsCount - 1, $firstSplitCents);

        // Last split = remaining cents
        $lastSplitCents = $totalCents - array_sum($splits);

        $splits[] = $lastSplitCents;

        // Convert back to dollars with 2 decimals
        $splits = array_map(fn ($c) => round($c / 100, 2), $splits);

        return $splits;
    }
}
