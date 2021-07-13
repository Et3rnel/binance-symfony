<?php

declare(strict_types=1);

namespace App\Action;

use App\Enum\BinanceSecurityType;

class NewOrderTestAction
{
    public function process()
    {

    }

    public function securityType()
    {
        return BinanceSecurityType::TRADE;
    }
}
