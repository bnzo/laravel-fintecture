<?php

namespace Bnzo\Fintecture\Http\Requests;

use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

/**
 * Request a PIS access token
 */
class RequestAccessToken extends Request implements Cacheable, HasBody
{
    use HasCaching, HasFormBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/oauth/accesstoken';
    }

    public function defaultBody(): array
    {
        return [
            'grant_type' => 'client_credentials',
            'scope' => 'pis',
            'app_id' => config('fintecture.app_id'),
        ];
    }

    public function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Basic '.base64_encode(config('fintecture.app_id').':'.config('fintecture.app_secret')),
        ];

    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store());
    }

    protected function getCacheableMethods(): array
    {
        return [Method::POST];
    }

    public function cacheExpiryInSeconds(): int
    {
        // One hour minus ten seconds
        return 3600 - 10;
    }
}
