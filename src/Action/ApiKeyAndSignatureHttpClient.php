<?php

declare(strict_types=1);

namespace App\Action;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

/**
 * @method  withOptions(array $options)
 */
class ApiKeyAndSignatureHttpClient implements HttpClientInterface
{
    private HttpClientInterface $decoratedClient;
    private string $binanceSecretKey;

    public function __construct(
        string $binanceApiKey,
        string $binanceSecretKey,
        HttpClientInterface $client = null
    )
    {
        $this->binanceSecretKey = $binanceSecretKey;

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
        /**
         * A SIGNED endpoint also requires a parameter, timestamp, to be sent which should be
         * the millisecond timestamp of when the request was created and sent.
         *
         * @see https://github.com/binance/binance-spot-api-docs/blob/master/rest-api.md#timing-security
         */
        $timestamp = round(microtime(true) * 1000);

        // Get query parameters and add the timestamp query param
        $queryParameters = [];
        if (array_key_exists('query', $options)) {
            $queryParameters = $options['query'];
        }

        $bodyParameters = [];
        if (array_key_exists('body', $options)) {
            $bodyParameters = $options['body'];
        }

        if ($method === Request::METHOD_GET) {
            $queryParameters['timestamp'] = $timestamp;
        } else {
            $bodyParameters['timestamp'] = $timestamp;
        }

        /**
         * Endpoints use HMAC SHA256 signatures. The HMAC SHA256 signature is a keyed HMAC SHA256 operation.
         * Use your secretKey as the key and totalParams as the value for the HMAC operation.
         * totalParams is defined as the query string concatenated with the request body.
         *
         * @see https://github.com/binance/binance-spot-api-docs/blob/master/rest-api.md#signed-trade-and-user_data-endpoint-security
         */
        $hashData = http_build_query($queryParameters) . http_build_query($bodyParameters);

        $signature = hash_hmac(
            'sha256',
            $hashData,
            $this->binanceSecretKey
        );

        if ($method === Request::METHOD_GET) {
            $queryParameters['signature'] = $signature;
        } else {
            $bodyParameters['signature'] = $signature;
        }


        $options['query'] = $queryParameters;
        $options['body'] = $bodyParameters;

//        dd($options);

        return $this->decoratedClient->request($method, $url, $options);
    }

    public function stream($responses, float $timeout = null): ResponseStreamInterface
    {
        return $this->decoratedClient->stream($responses, $timeout);
    }
}
