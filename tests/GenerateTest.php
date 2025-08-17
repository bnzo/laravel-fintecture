<?php

use Bnzo\Fintecture\Facades\Fintecture;
use Bnzo\Fintecture\Tests\FintectureTester;
use Fintecture\Util\FintectureException;
use GuzzleHttp\Psr7\Response;

it('can generate url', function () {
    FintectureTester::mockResponses([
        new Response(
            body: json_encode(['meta' => [
                'url' => 'https://mock.url/fintecture',
                'session_id' => 'mock_session_id',
            ]])
        ),
    ], );

    $url = Fintecture::generate();

    expect($url)->toBe('https://mock.url/fintecture');
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

    $url = Fintecture::generate();

    expect($url)->toBe('https://mock.url/fintecture');
})->throws(FintectureException::class, 'mock_error_message');
