<?php

use Bnzo\Fintecture\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;

it('can generate', function () {
    FintectureTester::mockResponses([
        ['access_token' => 'mock_access_token'],
        ['meta' => [
            'url' => 'https://test.url/fintecture',
            'session_id' => 'mock_session_id',
        ]],
    ]);

    $url = app(Fintecture::class)->generate();

    expect($url)->toBe('https://test.url/fintecture');
});
