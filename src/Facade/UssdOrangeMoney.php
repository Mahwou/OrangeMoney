<?php

namespace Courage\OrangeMoney\Facade;

use Illuminate\Support\Facades\Facade;

class UssdOrangeMoney extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "OrangeMoney";
    }
}
