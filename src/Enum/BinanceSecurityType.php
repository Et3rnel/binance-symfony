<?php

declare(strict_types=1);

namespace App\Enum;

class BinanceSecurityType
{
    public const NONE = 'NONE';
    public const TRADE = 'TRADE';
    public const USER_DATA = 'USER_DATA';
    public const USER_STREAM = 'USER_STREAM';
    public const MARKET_DATA = 'MARKET_DATA';
}
