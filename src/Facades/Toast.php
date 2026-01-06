<?php

namespace HassanIrfan527\LaravelToasts\Facades;

use Illuminate\Support\Facades\Facade;

class Toast extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-toast'; // This string must match the binder in the ServiceProvider
    }
}