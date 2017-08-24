<?php

namespace LukePOLO\LaravelPassportOneTimeToken;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/one-time-token.php' => config_path('one-time-token.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/config/one-time-token.php',
            'one-time-token'
        );

        $routeConfig = [
            'namespace' => 'LukePOLO\LaravelPassportOneTimeToken\Controllers',
            'prefix' => config('one-time-token.route_prefix'),
            'domain' => config('one-time-token.route_domain'),
            'middleware' => config('one-time-token.middleware'),
        ];

        $this->app['router']->group($routeConfig, function($router) {
            $router->post('create', [
                'uses' => 'OneTimeToken@store',
                'as' => 'one-time-token.create',
            ]);
        });

        $this->registerMiddleware(\LukePOLO\LaravelPassportOneTimeToken\Middleware\OneTimeToken::class);
    }

    /**
     * Register the Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $this->app['Illuminate\Contracts\Http\Kernel']->pushMiddleware($middleware);
    }
}
