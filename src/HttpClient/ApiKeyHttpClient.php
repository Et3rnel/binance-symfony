<?php

declare(strict_types=1);

namespace App\HttpClient;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

/**
 * @method  withOptions(array $options)
 */
class ApiKeyHttpClient implements HttpClientInterface
{
    private HttpClientInterface $decoratedClient;

    public function __construct(
        string $binanceApiKey,
        HttpClientInterface $client = null
    )
    {
        $this->decoratedClient = $client ?? HttpClient::create();
        $this->decoratedClient = $this->decoratedClient->withOptions(
            [
                'base_uri' => 'https://api.binance.com/',
                'headers' => [
                    'X-MBX-APIKEY' => $binanceApiKey,
                ],
            ]
        );
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        return $this->decoratedClient->request($method, $url, $options);
    }

    public function stream($responses, float $timeout = null): ResponseStreamInterface
    {
        return $this->decoratedClient->stream($responses, $timeout);
    }
}
