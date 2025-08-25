<?php

namespace Bnzo\Fintecture\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

class PaymentDTO extends Data
{
    public function __construct(
        #[MapInputName('meta')]
        public PaymentSettingsDTO $settings,
        #[MapInputName('data.attributes')]
        public PaymentAttributesDTO $attributes,
        #[MapInputName('meta')]
        public PaymentCustomerDTO $customer) {}

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
