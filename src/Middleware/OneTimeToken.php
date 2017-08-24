<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Middleware;

use Closure;
use Laravel\Passport\Token;

class OnetimeToken
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * @param $request
     */
    public function terminate($request)
    {
        /** @var Token $token */
        $token = $request->user()->token();
        if(str_contains($token->name, 'OneTimeToken')) {
            $token->revoke();
        }
    }
}
