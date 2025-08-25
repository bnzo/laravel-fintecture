<?php

namespace Bnzo\Fintecture\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

class PaymentRequestData extends Data
{
    public function __construct(
        #[MapInputName('meta')]
        public PaymentSettingsData $settings,
        #[MapInputName('data.attributes')]
        public PaymentAttributesData $attributes,
        #[MapInputName('meta')]
        public PaymentCustomerData $customer) {}

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
