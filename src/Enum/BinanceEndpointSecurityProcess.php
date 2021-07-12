<?php

declare(strict_types=1);

namespace App\Enum;

class BinanceEndpointSecurityProcess
{
    public const FREELY = [
        BinanceSecurityType::NONE,
    ];

    public const API_KEY = [
        BinanceSecurityType::USER_STREAM,
        BinanceSecurityType::MARKET_DATA,
    ];

    public const API_KEY_AND_SIGNATURE = [
        BinanceSecurityType::TRADE,
        BinanceSecurityType::USER_DATA,
    ];
}
