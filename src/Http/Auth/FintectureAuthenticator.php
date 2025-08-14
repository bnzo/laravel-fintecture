<?php

namespace Bnzo\Fintecture\Http\Auth;

use Bnzo\Fintecture\Http\Requests\RequestAccessToken;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class FintectureAuthenticator implements Authenticator
{
    public function set(PendingRequest $pendingRequest): void
    {
        // Make sure to ignore the authentication request to prevent loops.
        if ($pendingRequest->getRequest() instanceof RequestAccessToken) {
            return;
        }

        // Make a request to the Authentication endpoint using the same connector.
        $response = $pendingRequest->getConnector()->send(new RequestAccessToken);

        // Finally, authenticate the previous PendingRequest before it is sent.
        $pendingRequest->headers()->add('Authorization', 'Bearer '.$response->json('access_token'));
    }
}
