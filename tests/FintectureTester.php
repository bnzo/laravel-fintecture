<?php

namespace Bnzo\Fintecture\Tests;

use Bnzo\Fintecture\Data\ConfigData;
use Bnzo\Fintecture\Fintecture;
use GuzzleHttp\Psr7\Response;
use Http\Message\RequestMatcher\RequestMatcher;
use Http\Mock\Client;

class FintectureTester
{
    public static function mockResponses(array $responses, bool $withToken = true)
    {
        $client = new Client;

        if ($withToken) {
            $client = self::withToken($client);
        }

        foreach ($responses as $response) {
            $client->addResponse($response);
        }

        config([
            'fintecture.app_id' => env('FINTECTURE_APP_ID'),
            'fintecture.app_secret' => env('FINTECTURE_APP_SECRET'),
            'fintecture.environment' => env('FINTECTURE_ENVIRONMENT'),
            'fintecture.private_key' => env('FINTECTURE_PRIVATE_KEY'),
        ]);

        app()->singleton(Fintecture::class, function () use ($client) {
            $configDTO = ConfigData::fromArray(config('fintecture'));

            return new Fintecture($configDTO, $client);
        });
    }

    public static function withToken(Client $client): Client
    {
        $requestMatcher = new RequestMatcher(path: 'oauth/accesstoken');

        $response = new Response(
            body: json_encode(['access_token' => 'mock_access_token'])
        );

        $client->on($requestMatcher, $response);

        return $client;
    }
}
