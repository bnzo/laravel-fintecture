<?php

use Bnzo\Fintecture\Data\PaymentRequestData;
use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;
use Fintecture\Util\FintectureException;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->PaymentDTO = PaymentRequestData::from([
        'meta' => [
            'psu_name' => 'Julien Lefebvre',
            'psu_email' => 'julien.lefebre@my-business-sarl.com',
        ],
        'data' => [
            'attributes' => [
                'amount' => '272.00',
                'currency' => 'EUR',
                'communication' => 'test',
            ],
        ],
    ]);
});

it('can generate url', function () {
    FintectureTester::mockResponses([
        new Response(
            body: json_encode(['meta' => [
                'url' => 'https://mock.url/fintecture',
                'session_id' => 'mock_session_id',
            ]])
        ),
    ], );

    $paymentResponseData = Fintecture::generate('mock_state', 'https://mock.redirect.uri', $this->PaymentDTO);

    expect($paymentResponseData->url)->toBe('https://mock.url/fintecture');
});

it('can throw an exception generate url', function () {
    FintectureTester::mockResponses([
        new Response(
            status: 400,
            body: json_encode(['status' => '400', 'errors' => [
                [
                    'code' => 'mock_error_code',
                    'title' => 'mock_error_title',
                    'message' => 'mock_error_message',
                ],
            ]])
        ),
    ]);

    $paymentResponseData = Fintecture::generate('mock_state', 'https://mock.redirect.uri', $this->PaymentDTO);

})->throws(FintectureException::class, 'mock_error_message');
