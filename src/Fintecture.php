<?php

namespace Bnzo\Fintecture;

use Bnzo\Fintecture\Data\ConfigData;
use Bnzo\Fintecture\Data\PaymentData;
use Bnzo\Fintecture\Data\SessionData;
use Bnzo\Fintecture\Enums\PaymentStatus;
use Fintecture\PisClient;
use Fintecture\Util\FintectureException;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Client\ClientInterface;

class Fintecture
{
    protected PisClient $pisClient;

    public function __construct(protected ConfigData $configDTO, protected ?ClientInterface $client = null)
    {
        $this->pisClient = new PisClient($configDTO->toArray(), $this->client);
    }

    protected function setAccessToken()
    {
        $pisToken = Cache::remember('fintecture_pis_access_token', now()->addHour()->subMinute(), function () {
            $token = $this->pisClient->token->generate();

            if ($token->error) {
                throw new FintectureException($token->errorMsg);
            }

            return $token;
        });

        $this->pisClient->setAccessToken($pisToken);
    }

    public function generate(PaymentData $paymentData): SessionData
    {
        $this->setAccessToken();

        $connect = $this->pisClient->requestToPay->generate(
            data: $paymentData->toArray(),
            xLanguage: $paymentData->attributes->language,
            state: $paymentData->attributes->state instanceof \Spatie\LaravelData\Optional ? null : $paymentData->attributes->state,
            redirectUri: $paymentData->settings->redirectUri instanceof \Spatie\LaravelData\Optional ? null : $paymentData->settings->redirectUri,
        );
        if (! $connect->error) {
            return SessionData::from((array) $connect->result->meta);
        } else {
            throw new FintectureException($connect->errorMsg);
        }
    }

    public function getPayment(string $sessionId): SessionData
    {
        $this->setAccessToken();

        $payment = $this->pisClient->payment->get($sessionId);

        if (! $payment->error) {

            return SessionData::from((array) $payment->result->meta);
        } else {
            throw new FintectureException($payment->errorMsg);
        }

    }

    public function cancelPayment(string $sessionId): bool
    {
        $this->setAccessToken();

        $payment = $this->pisClient->payment->update($sessionId, ['meta' => ['status' => PaymentStatus::PaymentCancelled->value]]);

        if (! $payment->error) {
            $sessionData = SessionData::from((array) $payment->result->meta);

            return $sessionData->status === 'payment_cancelled';
        } else {
            throw new FintectureException($payment->errorMsg);
        }
    }
}
