<?php

namespace Bnzo\Fintecture;

use Bnzo\Fintecture\Http\FintectureConnector;
use Bnzo\Fintecture\Http\Requests\CreateTheConnectUrl;
use Saloon\Http\Response;

class Fintecture
{
    public function __construct(public FintectureConnector $connector) {}

    public function generateUrl(): Response
    {
        return $this->connector->send(new CreateTheConnectUrl);
    }
}
