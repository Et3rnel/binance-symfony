<?php

declare(strict_types=1);

namespace App\Enum\Order;

class OrderType
{
    public const LIMIT = 'LIMIT';
    public const MARKET = 'MARKET';
    public const STOP_LOSS = 'STOP_LOSS';
    public const STOP_LOSS_LIMIT = 'STOP_LOSS_LIMIT';
    public const TAKE_PROFIT = 'TAKE_PROFIT';
    public const TAKE_PROFIT_LIMIT = 'TAKE_PROFIT_LIMIT';
    public const LIMIT_MAKER = 'LIMIT_MAKER';
}
