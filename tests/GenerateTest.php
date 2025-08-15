<?php

use Bnzo\Fintecture\Fintecture;
use Fintecture\PisClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

it('can generate', function () {

    $mock = new MockHandler([
        new Response(200, [], json_encode(['access_token' => 'mock_access_token'])),
        new Response(200, [], json_encode(['meta' => [
            'url' => 'https://mock.url/fintecture',
            'session_id' => 'mock_session_id',
        ]])),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    app()->singleton(Fintecture::class, function ($app) use ($client) {
        return new Fintecture(new PisClient([
            'appId' => 'ok',
            'appSecret' => 'ok',
            'privateKey' => base64_decode(config('fintecture.private_key')),
            'environment' => config('fintecture.environment'),
        ], $client));
    });

    $url = app(Fintecture::class)->generate();

    expect($url)->toBe('https://mock.url/fintecture');

});
