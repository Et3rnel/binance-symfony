<?php

declare(strict_types=1);

namespace App\Enum;

class BinanceEndpointSecurityProcess
{
    // No requirement
    public const FREE = [
        BinanceSecurityType::NONE,
    ];

    // Need to set the api key in headers
    public const API_KEY = [
        BinanceSecurityType::USER_STREAM,
        BinanceSecurityType::MARKET_DATA,
    ];

    // Need to set the api key and hmac signature in request query or body
    public const SIGNED = [
        BinanceSecurityType::TRADE,
        BinanceSecurityType::USER_DATA,
    ];
}
