<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('app.url', 'https://mysite.com');
    }

    protected function getPackageProviders($app)
    {
        return [
            \LukePOLO\LaravelPassportOneTimeToken\ServiceProvider::class,
        ];
    }

    protected function withConfig(array $config)
    {
        $this->app['config']->set($config);
    }
}