<?php

namespace Bnzo\Fintecture\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request a PIS access token
 */
class InitiateRequestToPay extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/pis/v2/request-to-pay';
    }

    public function defaultQuery(): array
    {
        return [
            'state' => 'test_state',
            'redirect_uri' => 'https://fintecture.agicom.fr/callback',
        ];
    }

    public function defaultBody(): array
    {
        return ['meta' => [
            'psu_address' => [
                'number' => '2',
                'street' => 'rue Marie Stuart',
                'city' => 'PARIS',
                'zip' => '75002',
                'country' => 'FR',
            ],
            'delivery_address' => [
                'number' => '2',
                'street' => 'rue Marie Stuart',
                'city' => 'PARIS',
                'zip' => '75002',
                'country' => 'FR',
            ],
            'psu_name' => 'Julien Lefebre',
            'psu_email' => 'julien.lefebre@gmail.com',
            'psu_phone' => '09743593535',
            'psu_company' => 'My Business SARL',
            'psu_incorporation' => '123456789',
            'cart_items' => [
                [
                    'label' => 'Energy Battery',
                    'quantity' => '1',
                    'amount' => '1400',
                    'external_id' => '012520',
                ],
                [
                    'label' => 'Shipping',
                    'quantity' => '1',
                    'amount' => '0',
                    'external_id' => '079010',
                ],
            ],
            'delivery_method' => 'My delivery method',
        ],
            'data' => [
                'attributes' => [
                    'amount' => '273.00',
                    'currency' => 'EUR',
                    'communication' => 'B34970692',
                ],
                'type' => 'payments',
            ],
        ];
    }
}
