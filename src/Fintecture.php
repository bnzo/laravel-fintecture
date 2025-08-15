<?php

namespace Bnzo\Fintecture;

use Fintecture\PisClient;

class Fintecture
{
    public function __construct(protected PisClient $pisClient) {}

    public function generate()
    {
        $state = uniqid(); // it's my transaction ID, I have to generate it myself, it will be sent back in the callback

        $pisToken = $this->pisClient->token->generate();
        if (! $pisToken->error) {
            $this->pisClient->setAccessToken($pisToken); // set token of PIS client
        } else {
            echo $pisToken->errorMsg;
        }

        $payload = [
            'meta' => [
                // Info of the buyer
                'psu_name' => 'M. John Doe',
                'psu_email' => 'john@doe.com',
                'psu_address' => [
                    'street' => '5 Void Street',
                    'zip' => '12345',
                    'city' => 'Gotham',
                    'country' => 'FR',
                ],
            ],
            'data' => [
                'type' => 'SEPA',
                'attributes' => [
                    'amount' => '550.60',
                    'currency' => 'EUR',
                    'communication' => 'Commande N°15654',
                ],
            ],
        ];

        $connect = $this->pisClient->connect->generate($payload, $state);
        if (! $connect->error) {

            eval(\Psy\sh());

            $this->pisClient->redirect($connect->meta->url);
        } else {
            echo $connect->errorMsg;
        }
    }
}
