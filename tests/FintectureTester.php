<?php

namespace Bnzo\Fintecture\Tests;

use Bnzo\Fintecture\Fintecture;
use Fintecture\PisClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Arr;

class FintectureTester
{
    public static function mockResponses(array $responses)
    {
        $mock = new MockHandler(
            Arr::map($responses, fn ($data) => new Response(200, [], json_encode($data)))
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        app()->singleton(Fintecture::class, function ($app) use ($client) {
            return new Fintecture(new PisClient([
                'appId' => 'test',
                'appSecret' => 'test',
                'privateKey' => base64_decode(config('fintecture.private_key')),
                'environment' => 'sandbox',
            ], $client));
        });
    }
}
