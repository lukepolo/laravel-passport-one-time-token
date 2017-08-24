<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Controllers;

use Illuminate\Http\Request;

class OneTimeToken
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if($request->user()) {
            return $request->user()->createToken('OneTimeToken', config('one-time-token.scopes'));
        }

        return response('Not Authorized.', 401);
    }
}