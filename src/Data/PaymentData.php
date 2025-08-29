<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

class PaymentData extends Data
{
    public function __construct(
        #[MapInputName('data.attributes')]
        public AttributesData $attributes,
        #[MapInputName('meta')]
        public CustomerData $customer,
        #[MapInputName('meta')]
        public ?SettingsData $settings = new SettingsData) {}

    public function transform(
        null|TransformationContextFactory|TransformationContext $transformationContext = null,
    ): array {
        return [
            'meta' => array_merge(
                $this->customer->transform($transformationContext),
                $this->settings->transform($transformationContext),
            ),
            'data' => [
                'attributes' => $this->attributes->transform($transformationContext),
            ],
        ];
    }
}
