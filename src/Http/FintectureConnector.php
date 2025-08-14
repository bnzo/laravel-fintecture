<?php

namespace Bnzo\Fintecture\Http;

use Bnzo\Fintecture\Http\Auth\FintectureAuthenticator;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class FintectureConnector extends Connector
{
    use AcceptsJson;

    public function defaultAuth(): ?Authenticator
    {
        return new FintectureAuthenticator;
    }

    public function resolveBaseUrl(): string
    {
        return config('fintecture.base_url');
    }

    protected function defaultHeaders(): array
    {
        return [
            // 'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    }
}
