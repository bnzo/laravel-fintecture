<?php

use Bnzo\Fintecture\Enums\PaymentStatus;
use Bnzo\Fintecture\Events\PaymentCreated;
use Bnzo\Fintecture\Events\PaymentUnsuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('fintecture')->group(function () {
    Route::post('/webhook', function (Request $request) {
        // event payment_session.transfer_states.completed
        // event payment_session.status.payment_created

        $sessionId = $request->get('session_id');
        $status = PaymentStatus::tryFrom($request->get('status'));

        match ($status) {
            PaymentStatus::PaymentCreated => PaymentCreated::dispatch($sessionId),
            PaymentStatus::PaymentUnsuccessful => PaymentUnsuccessful::dispatch($sessionId),
            default => null,
        };
    });
});
