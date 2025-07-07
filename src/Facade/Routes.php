<?php

namespace Budgetcontrol\Gateway\Facade;

use Illuminate\Support\Facades\Facade;

class Routes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'routes';
    }

    public static function getRoutes()
    {
        return static::getFacadeRoot();
    }

    public static function getRoute(string $name)
    {
        return static::getFacadeRoot()[$name] ?? null;
    }
}