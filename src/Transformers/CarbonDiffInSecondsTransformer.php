<?php

namespace Bnzo\Fintecture\Transformers;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class CarbonDiffInSecondsTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): mixed
    {
        if ($value instanceof Carbon) {
            return (int) abs($value->diffInSeconds(now()));
        }

        return null;
    }
}
