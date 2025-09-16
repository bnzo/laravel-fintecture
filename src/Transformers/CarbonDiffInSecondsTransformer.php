<?php

namespace Bnzo\Fintecture\Transformers;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class CarbonDiffInSecondsTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): ?int
    {
        if ($value instanceof DateTimeInterface) {
            // Convert to Carbon for uniform handling
            $value = $value instanceof Carbon ? $value : Carbon::instance($value);

            return (int) abs($value->diffInSeconds(now()));
        }

        return null;
    }
}
