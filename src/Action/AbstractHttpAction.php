<?php

declare(strict_types=1);

namespace App\Action;

use App\Enum\BinanceEndpointSecurityProcess;
use App\HttpClient\ApiKeyAndSignatureHttpClient;
use App\HttpClient\ApiKeyHttpClient;
use App\HttpClient\FreeHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractHttpAction
{
    protected HttpClientInterface $binanceHttpClient;

    public function __construct(
        ApiKeyAndSignatureHttpClient $apiKeyAndSignatureHttpClient,
        ApiKeyHttpClient $apiKeyHttpClient,
        FreeHttpClient $freeHttpClient
    )
    {
        // TODO : explain the difference between static and self
        $securityType = static::securityType();

        if (in_array($securityType, BinanceEndpointSecurityProcess::SIGNED)) {
            $this->binanceHttpClient = $apiKeyAndSignatureHttpClient;
        } else if (in_array($securityType, BinanceEndpointSecurityProcess::API_KEY)) {
            $this->binanceHttpClient = $apiKeyHttpClient;
        } else {
            $this->binanceHttpClient = $freeHttpClient;
        }
    }

    /**
     * Defines the binance route security type to determine the required parameters
     */
    abstract protected function securityType();

    /**
     * Http call the binance endpoint and returns the response
     */
    abstract public function call();
}
