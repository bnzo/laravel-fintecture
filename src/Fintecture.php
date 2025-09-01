<?php

namespace Bnzo\Fintecture;

use Bnzo\Fintecture\Data\ConfigData;
use Bnzo\Fintecture\Data\PaymentData;
use Bnzo\Fintecture\Data\SessionData;
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
            state: $paymentData->attributes->state,
            redirectUri: $paymentData->attributes->redirectUri,
        );
        if (! $connect->error) {
            return SessionData::from((array) $connect->result->meta);
        } else {
            throw new FintectureException($connect->errorMsg);
        }
    }

    public function getPayment($sessionId)
    {
        // be65006650f94e5cb04457d31a4e3651
        $this->setAccessToken();

        $payment = $this->pisClient->payment->get($sessionId);

        if (! $payment->error) {

            return SessionData::from((array) $payment->result->meta);
        } else {
            throw new FintectureException($payment->errorMsg);
        }

    }
}
