<?php

namespace Courage\OrangeMoney\Facade;

use Courage\OrangeMoney\OrangeMoney;
use Illuminate\Support\Facades\Facade;

class UssdOrangeMoney extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return OrangeMoney::class;
    }
}
