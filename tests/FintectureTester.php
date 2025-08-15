<?php

namespace Bnzo\Fintecture\Tests;

use Bnzo\Fintecture\Fintecture;
use Fintecture\PisClient;
use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;

class FintectureTester
{
    public static function mockResponses(array $responses)
    {
        $client = new Client;

        foreach ($responses as $data) {
            $client->addResponse(
                new Response(
                    status: 200,
                    headers: [],
                    body: json_encode($data)
                )
            );
        }

        app()->singleton(Fintecture::class, function () use ($client) {
            return new Fintecture(new PisClient([
                'appId' => 'test',
                'appSecret' => 'test',
                'privateKey' => base64_decode(config('fintecture.private_key')),
                'environment' => 'sandbox',
            ], $client));
        });
    }
}
