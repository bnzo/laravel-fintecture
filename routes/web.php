<?php

use App\Events\PaymentCreated;
use App\Events\PaymentUnsuccessful;
use Bnzo\Fintecture\Enums\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('fintecture')->group(function () {
    Route::post('/webhook', function (Request $request) {
        $status = $request->get('status');
        $sessionId = $request->get('session_id');

        match ($status) {
            PaymentStatus::PaymentCreated->value => PaymentCreated::dispatch($sessionId),
            PaymentStatus::PaymentUnsuccessful->value => PaymentUnsuccessful::dispatch($sessionId),
        };
    });
});
