<?php

use Bnzo\Fintecture\DTO\PaymentDTO;
use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;
use Fintecture\Util\FintectureException;
use GuzzleHttp\Psr7\Response;

it('can throw an exception if token generation fails', function () {
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
    ], withToken: false);

    $url = Fintecture::generate('mock_state', 'https://mock.redirect.uri', PaymentDTO::from([
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
    ]));

    expect($url)->toBe('https://mock.url/fintecture');
})->throws(FintectureException::class, 'mock_error_message');
