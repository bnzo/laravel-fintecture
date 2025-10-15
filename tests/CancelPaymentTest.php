<?php

use Bnzo\Fintecture\Data\PaymentData;
use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;
use GuzzleHttp\Psr7\Response;

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

it('can cancel payment', function () {
    FintectureTester::mockResponses([
        new Response(
            body: json_encode(['meta' => [
                'session_id' => '22db841679424e0dac5714ddefdbbfbe',
                'status' => 'payment_cancelled',
            ]])
        ),
    ], );

    $paymentResponseData = Fintecture::cancelPayment('22db841679424e0dac5714ddefdbbfbe');
    expect($paymentResponseData)->toBeTrue();
});
