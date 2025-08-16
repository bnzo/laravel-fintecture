<?php

use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;
use GuzzleHttp\Psr7\Response;

it('can generate', function () {
    FintectureTester::mockResponses([
        new Response(
            body: json_encode(['access_token' => 'mock_access_token'])
        ),
        new Response(

            body: json_encode(['meta' => [
                'url' => 'https://mock.url/fintecture',
                'session_id' => 'mock_session_id',
            ]], )
        ),
    ]);

    $url = Fintecture::generate();

    expect($url)->toBe('https://mock.url/fintecture');
});
