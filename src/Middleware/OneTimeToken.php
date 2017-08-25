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
        $user = $request->user();

        if(!empty($user)) {
            /** @var Token $token */
            $token = $user->token();
            if(!empty($token) && str_contains($token->name, 'OneTimeToken')) {
                $token->revoke();
            }
        }
    }
}
