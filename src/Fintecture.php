<?php

namespace Bnzo\Fintecture;

use Bnzo\Fintecture\Data\ConfigData;
use Bnzo\Fintecture\Data\PaymentRequestData;
use Bnzo\Fintecture\Data\PaymentResponseData;
use Fintecture\PisClient;
use Fintecture\Util\FintectureException;
use Psr\Http\Client\ClientInterface;

class Fintecture
{
    protected PisClient $pisClient;

    public function __construct(protected ConfigData $configDTO, protected ?ClientInterface $client = null)
    {
        $this->pisClient = new PisClient($configDTO->toArray(), $this->client);
    }

    public function generate(string $state, string $redirectUri, PaymentRequestData $paymentData): PaymentResponseData
    {
        $state = uniqid(); // it's my transaction ID, I have to generate it myself, it will be sent back in the callback
        $redirectUri = 'https://fintecture.agicom.fr/callback'; // replace with your redirect URI
        $pisToken = $this->pisClient->token->generate();
        if (! $pisToken->error) {
            $this->pisClient->setAccessToken($pisToken); // set token of PIS client
        } else {
            throw new FintectureException($pisToken->errorMsg);
        }

        $connect = $this->pisClient->connect->generate(
            data: $paymentData->toArray(),
            state: $state,
            redirectUri: $redirectUri, // replace with your redirect URI
        );
        if (! $connect->error) {
            return PaymentResponseData::from((array) $connect->result->meta);
        } else {
            throw new FintectureException($connect->errorMsg);
        }
    }
}
