<?php

namespace Courage\OrangeMoney\Facades;

use Illuminate\Support\Facades\Facade;

class UssdOrangeMoney extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "UssdOrangeMoney";
    }
}
