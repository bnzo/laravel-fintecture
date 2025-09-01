<?php

use Bnzo\Fintecture\Data\PaymentData;
use Bnzo\Fintecture\Enums\PaymentStatus;
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

it('can get payment', function () {
    FintectureTester::mockResponses([
        new Response(
            body: json_encode(['meta' => [
                'status' => 'payment_created',
                'session_id' => 'mock_session_id',
            ]])
        ),
    ], );

    $paymentResponseData = Fintecture::getPayment('f2b05d307f684049b204c8a8d127ca71');

    // expect($paymentResponseData->status)->toBe(PaymentStatus::PaymentCreated);
    expect($paymentResponseData->sessionId)->toBe('mock_session_id');
});
