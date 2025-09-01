<?php

namespace Bnzo\Fintecture\Facades;

use Bnzo\Fintecture\Data\PaymentData;
use Bnzo\Fintecture\Data\SessionData;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Bnzo\Fintecture\Fintecture
 *
 * @method static SessionData generate(PaymentData $paymentData, ?string $redirectUri = null)
 * @method static SessionData getPayment(string $sessionId)
 */
class Fintecture extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Bnzo\Fintecture\Fintecture::class;
    }
}
