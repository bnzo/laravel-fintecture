<?php

namespace Bnzo\Fintecture;

use Fintecture\PisClient;

class Fintecture
{
    public function __construct(protected PisClient $pisClient) {}

    public function generate()
    {
        $state = uniqid(); // it's my transaction ID, I have to generate it myself, it will be sent back in the callback
        $redirectUri = 'https://fintecture/callback'; // replace with your redirect URI

        $pisToken = $this->pisClient->token->generate();
        if (! $pisToken->error) {
            $this->pisClient->setAccessToken($pisToken); // set token of PIS client
        } else {
            echo $pisToken->errorMsg;
        }

        $payload = [
            'meta' => [
                'permanent' => false,
                'psu_name' => 'Julien Lefebvre',
                'psu_email' => 'julien.lefebre@my-business-sarl.com',
                'psu_company' => 'My Business Sarl',
                'psu_form' => 'SARL',
                'expiry' => 84000,
                'due_date' => 84000,
                'scheduled_expiration_policy' => 'immediate',
                'method' => 'link',
            ],
            'data' => [
                'attributes' => [
                    'amount' => '273.00',
                    'currency' => 'EUR',
                    'communication' => 'test',
                ],
            ],
        ];

        $connect = $this->pisClient->connect->generate(
            data: $payload,
            state: $state,
            redirectUri: $redirectUri, // replace with your redirect URI
        );
        if (! $connect->error) {
            return $connect->meta->url;
        } else {
            echo $connect->errorMsg;
        }
    }
}
