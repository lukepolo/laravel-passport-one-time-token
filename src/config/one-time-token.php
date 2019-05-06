<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tokens name that we check to see if it should be a one time use
    |--------------------------------------------------------------------------
    |
    */
    'token_name' => 'OneTimeToken',

    /*
     |--------------------------------------------------------------------------
     | Route prefix
     |--------------------------------------------------------------------------
     |
     */
    'route_prefix' => 'oauth/one-time',

    /*
     |--------------------------------------------------------------------------
     | Route domain
     |--------------------------------------------------------------------------
     |
     | By default the routes are served from the same domain that request served.
     | To override default domain, specify it as a non-empty value.

     */
    'route_domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Default Middleware
    |--------------------------------------------------------------------------
    |
    */
    'middleware' => [
        'auth:api',
    ],

    /*
     |--------------------------------------------------------------------------
     | Scopes - https://laravel.com/docs/master/passport#token-scopes
     |--------------------------------------------------------------------------
     |
     | By default there are no scopes limiting the user.
     | I strongly suggest you use a scope to protect your data
     |
     */
    'scopes' => [

    ],

];