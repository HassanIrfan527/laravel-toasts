<?php

namespace HassanIrfan527\LaravelToasts\Tests;

use HassanIrfan527\LaravelToasts\LaravelToastsServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LaravelToastsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Set a dummy app key for session/cookie encryption
        $app['config']->set('app.key', 'base64:6Cu6otK4uPz994073359677350414732');
    }
}