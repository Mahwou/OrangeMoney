<?php

namespace Courage\OrangeMoney\Facade;

use Courage\OrangeMoney\UssdOrangeMoney as OrangeMoney;
use Illuminate\Support\Facades\Facade;

/**
 * @method static pay(array $data)
 * @method static checkTransactionStatus(string $payToken)
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
