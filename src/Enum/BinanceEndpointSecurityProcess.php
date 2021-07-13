<?php

declare(strict_types=1);

namespace App\Enum;

class BinanceEndpointSecurityProcess
{
    public const FREE = [
        BinanceSecurityType::NONE,
    ];

    public const API_KEY = [
        BinanceSecurityType::USER_STREAM,
        BinanceSecurityType::MARKET_DATA,
    ];

    public const SIGNED = [
        BinanceSecurityType::TRADE,
        BinanceSecurityType::USER_DATA,
    ];
}
