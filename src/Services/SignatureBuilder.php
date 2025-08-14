<?php

namespace Bnzo\Fintecture\Services;

use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class SignatureBuilder
{
    protected string $appId;

    protected string $privateKey;

    protected string $method = 'post';

    protected string $path;

    protected array $params = [];

    protected array $body = [];

    protected Collection $headers;

    protected string $payload;

    public static function make(string $appId, string $privateKey): self
    {
        return new self($appId, $privateKey);
    }

    public function __construct(string $appId, string $privateKey)
    {
        $this->appId = $appId;
        $this->privateKey = $privateKey;
        $this->headers = collect();
    }

    public function method(string $method): self
    {
        $this->method = strtolower($method);

        return $this;
    }

    public function path(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function params(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    public function body(array $body): self
    {
        $this->body = $body;

        return $this;
    }

    protected function prepare(): void
    {
        $this->payload = json_encode($this->body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $date = now()->toRfc7231String();
        $digest = 'SHA-256='.base64_encode(hash('sha256', $this->payload, true));
        $requestId = Uuid::uuid4()->toString();

        $this->headers = collect([
            'date' => $date,
            'digest' => $digest,
            'x-request-id' => $requestId,
        ]);
    }

    protected function headersString(): string
    {
        return $this->headers
            ->map(fn ($value, $key) => "\\n{$key}: {$value}")
            ->implode('');
    }

    protected function queryString(): string
    {
        return http_build_query($this->params, '', '&', PHP_QUERY_RFC3986);
    }

    protected function signingString(): string
    {
        $target = $this->path.'?'.$this->queryString();

        return "(request-target): {$this->method} {$target}{$this->headersString()}";
    }

    public function build(): string
    {
        $this->prepare();

        openssl_sign(
            $this->signingString(),
            $rawSignature,
            $this->privateKey,
            OPENSSL_ALGO_SHA256
        );

        $signature = base64_encode($rawSignature);
        $headerKeys = $this->headers->keys()->implode(' ');

        return 'keyId="'.$this->appId.
            '",algorithm="rsa-sha256",headers="(request-target) '.$headerKeys.
            '",signature="'.$signature.'"';
    }
}

// $signatureHeader = SignatureBuilder::make($appId, $privateKey)
//     ->method('post')
//     ->path('/pis/v2/connect')
//     ->params([
//         'state' => 'pending',
//         'redirect_uri' => 'redirect',
//     ])
//     ->body([])
//     ->build();

// echo $signatureHeader;
