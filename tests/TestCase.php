<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Tests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Auth::routes();

    }

    protected function getPackageProviders($app)
    {
        return [
            \LukePOLO\LaravelPassportOneTimeToken\ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'config' => Config::class
        ];
    }

    protected function withConfig(array $config)
    {
        $this->app['config']->set($config);
    }
}