<?php

use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Http\Requests\CreateTheConnectUrl;
use Bnzo\Fintecture\Http\Requests\RequestAccessToken;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

it('can generate an URL', function () {
    Saloon::fake([
        RequestAccessToken::class => MockResponse::fixture('auth'),
        CreateTheConnectUrl::class => MockResponse::fixture('connect-url'),
    ]);

    $response = Fintecture::generateUrl();

    expect($response->json('meta.session_id'))->toBe('b98843c908894657899b99ced11036e8');
    expect($response->json('meta.url'))->toBe('https://connect.sandbox.fintecture.com/v2/92cedaec-22f6-4100-a3f6-4cd074a8b2c6');

});
