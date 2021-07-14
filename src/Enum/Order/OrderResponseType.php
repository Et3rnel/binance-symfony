<?php

declare(strict_types=1);

namespace App\Enum\Order;

/**
 * MARKET and LIMIT order types default to FULL, all other orders default to ACK.
 *
 * @see https://github.com/binance/binance-spot-api-docs/blob/master/rest-api.md#new-order--trade
 */
class OrderResponseType
{
    public const ACK = 'ACK';
    public const RESULT = 'RESULT';
    public const FULL = 'FULL';
}
