<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Middleware;

use Closure;
use Laravel\Passport\Token;

class OnetimeTokenMiddleware
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

            if(!empty($token) && $token->transient() === false && strpos($token->name, config('one-time-token.token_name')) >= 0) {
                $token->revoke();
            }
        }
    }
}
