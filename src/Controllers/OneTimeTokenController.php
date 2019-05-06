<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Controllers;

use Illuminate\Http\Request;

class OneTimeTokenController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if($request->user()) {
            return $request->user()->createToken(config('one-time-token.token_name'), config('one-time-token.scopes'));
        }

        return response('Not Authorized.', 401);
    }
}