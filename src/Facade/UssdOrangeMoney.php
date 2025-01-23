<?php

namespace Courage\OrangeMoney\Facade;

use Courage\OrangeMoney\OrangeMoney;
use Illuminate\Support\Facades\Facade;

/**
 * @method pay(array $data)
 * @method checkTransactionStatus(string $payToken)
 *
 * @see OrangeMoney;
 */
final class UssdOrangeMoney extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return OrangeMoney::class;
    }
}
