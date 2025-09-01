<?php

use Bnzo\Fintecture\Data\AddressData;
use Bnzo\Fintecture\Data\AttributesData;
use Bnzo\Fintecture\Data\CustomerData;
use Bnzo\Fintecture\Data\PaymentData;
use Bnzo\Fintecture\Data\SettingsData;
use Bnzo\Fintecture\Enums\Method;
use Bnzo\Fintecture\Enums\ScheduledExpirationPolicy;
use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;
use Fintecture\Util\FintectureException;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->paymentData = PaymentData::from([
        'meta' => [
            'psu_name' => 'Julien Lefebvre',
            'psu_email' => 'nbenzoni@agicom.fr',
            'method' => 'email',
        ],
        'data' => [
            'attributes' => [
                'amount' => '272.00',
                'communication' => 'test',
                'language' => 'fr',
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
                'status' => 201,
            ]])
        ),
    ], );

    $sessionData = Fintecture::generate($this->paymentData);

    expect($sessionData->url)->toBe('https://mock.url/fintecture');
    expect($sessionData->sessionId)->toBe('mock_session_id');
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

    Fintecture::generate($this->paymentData);

})->throws(FintectureException::class, 'mock_error_message');

it('generate data', function () {
    $paymentData = new PaymentData(
        new AttributesData(
            amount: '272.00',
            communication: 'test',
        ),
        new CustomerData(
            email: 'julien.lefebre@my-business-sarl.com',
            name: 'Julien Lefebvre',
            address: new AddressData(
                street: '123 Main St',
                zip: '75001',
                city: 'Paris',
                country: 'FR'
            )
        ),
        new SettingsData(
            expiry: 86400,
            due_date: 86400,
            permanent: false,
            scheduled_expiration_policy: ScheduledExpirationPolicy::Immediate,
            method: Method::Link,
        )
    );

});
