<?php

declare(strict_types=1);

namespace App\Action;

use App\Enum\BinanceSecurityType;
use App\Enum\Order\OrderSide;
use App\Enum\Order\OrderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * MARKET orders using the quantity field specifies the amount of the base asset the user wants to
 * buy or sell at the market price.
 *
 * E.g. MARKET order on BTCUSDT will specify how much BTC the user is buying or selling.
 * MARKET orders using quoteOrderQty specifies the amount the user wants to spend (when buying) or
 * receive (when selling) the quote asset; the correct quantity will be determined based on the market liquidity and quoteOrderQty.
 *
 * E.g. Using the symbol BTCUSDT:
 * BUY side, the order will buy as many BTC as quoteOrderQty USDT can.
 * SELL side, the order will sell as much BTC needed to receive quoteOrderQty USDT.
 */
final class PostMarketOrderAction extends AbstractHttpAction
{
    /**
     * Current exchange trading rules and symbol information
     */
    public function call(): ResponseInterface
    {
        // TODO : finish route
        return $this->binanceHttpClient->request(
            Request::METHOD_POST,
            '/api/v3/order/test',
            [
                'body' => [
                    'symbol' => 'BNBUSDT',
                    'side' => OrderSide::BUY,
                    'type' => OrderType::MARKET,
                    'quoteOrderQty' => 500000,
                ],
            ],
        );
    }

    protected function securityType(): string
    {
        return BinanceSecurityType::TRADE;
    }
}
