<?php

declare(strict_types=1);

namespace App\Action;

use App\Enum\BinanceSecurityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class GetExchangeInfoAction extends AbstractHttpAction
{
    /**
     * Current exchange trading rules and symbol information
     */
    public function call(): ResponseInterface
    {
        // TODO : add symbol and symbols as parameter
        return $this->binanceHttpClient->request(Request::METHOD_GET, '/api/v3/exchangeInfo');
    }

    protected function securityType(): string
    {
        return BinanceSecurityType::NONE;
    }
}
