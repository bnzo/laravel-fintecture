<?php

namespace Bnzo\Fintecture\Tests;

use Bnzo\Fintecture\DTO\ConfigDTO;
use Bnzo\Fintecture\Fintecture;
use Http\Mock\Client;

class FintectureTester
{
    public static function mockResponses(array $responses)
    {
        $client = new Client;

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
            $configDTO = ConfigDTO::fromArray(config('fintecture'));

            return new Fintecture($configDTO, $client);
        });
    }
}
