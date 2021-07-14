<?php

declare(strict_types=1);

namespace App\Model;

class Symbol
{
    /**
     * The base asset refers to the asset that is the quantity of a symbol.
     * For the symbol BTCUSDT, BTC would be the base asset.
     */
    private string $baseAsset;

    /**
     * The quote asset refers to the asset that is the price of a symbol.
     * For the symbol BTCUSDT, USDT would be the quote asset.
     */
    private string $quoteAsset;

    public function __construct(string $baseAsset, string $quoteAsset)
    {
        $this->baseAsset = $baseAsset;
        $this->quoteAsset = $quoteAsset;
    }

    public function getBaseAsset(): string
    {
        return $this->baseAsset;
    }

    public function getQuoteAsset(): string
    {
        return $this->quoteAsset;
    }
}
