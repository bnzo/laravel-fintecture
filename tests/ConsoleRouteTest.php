<?php

use Bnzo\Fintecture\Data\PaymentData;

beforeEach(function () {
    $this->PaymentRequestData = PaymentData::from([
        'meta' => [
            'psu_name' => 'Julien Lefebvre',
            'psu_email' => 'julien.lefebre@my-business-sarl.com',
        ],
        'data' => [
            'attributes' => [
                'amount' => '272.00',
                'communication' => 'test',
            ],
        ],
    ]);
});

it('can route to console', function () {
    $url = route('fintecture.console', ['sessionId' => '91b804d5e316428f8287874ae45ba7a8']);
    expect($url)->toBe('https://console.fintecture.com/payments/detail/sandbox/91b804d5e316428f8287874ae45ba7a8');
});
