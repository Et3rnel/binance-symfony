<?php

declare(strict_types=1);

namespace App\Enum;

class TimeInForce
{
    /**
     * Good Til Canceled
     * An order will be on the book unless the order is canceled.
     */
    public const GTC = 'GTC';

    /**
     * Immediate Or Cancel
     * An order will try to fill the order as much as it can before the order expires.
     */
    public const IOC = 'IOC';

    /**
     * Fill or Kill
     * An order will expire if the full order cannot be filled upon execution.
     */
    public const FOK = 'FOK';
}
