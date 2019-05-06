<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Tests;

use Mockery as m;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Laravel\Passport\TransientToken;
use LukePOLO\LaravelPassportOneTimeToken\Middleware\OnetimeTokenMiddleware;
use LukePOLO\LaravelPassportOneTimeToken\Controllers\OneTimeTokenController;

class TokenTest extends TestCase
{
    /** @var OnetimeTokenMiddleware */
    protected $middleware;

    /** @var OneTimeTokenController */
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new OnetimeTokenMiddleware();
        $this->controller = new OneTimeTokenController();
    }

    public function testCanGetToken()
    {
        $tokenValue = '1asdfaksjldfk;lasdjfk;';
        $request = Request::create('/', 'POST');

        $request->setUserResolver(function () use($tokenValue) {
            $user = m::mock();
            $user->shouldReceive('createToken')->andReturn($tokenValue);
            return $user;
        });

        $this->assertEquals($this->controller->store($request), $tokenValue);
    }

    public function testTokenScopes()
    {
        $setScopes = [
            'OnlyAdmins',
        ];

        $this->app['config']->set('one-time-token.scopes', $setScopes);

        $request = Request::create('/', 'POST');

        $request->setUserResolver(function () use($setScopes) {
            $user = m::mock();
            $user->shouldReceive('createToken')->withArgs(function($name, $scopes) use($setScopes) {
                if($name === config('one-time-token.token_name') && $scopes === $setScopes) {
                    return true;
                }
            });
            return $user;
        });

        $this->controller->store($request);
    }


    public function testNonLoggedInUser()
    {
        $request = Request::create('/', 'POST');

        $this->assertEquals($this->controller->store($request)->status(), 401);
    }

    public function testTokenMiddleware()
    {
        $request = Request::create('/', 'POST');


        $request->setUserResolver(function () {
            $user = m::mock();

            $token = m::mock(Token::class.'[revoke]');
            $token->name = 'OneTimeToken';
            $token->shouldReceive('revoke')->once();
            $user->shouldReceive('token')->andReturn($token);
            return $user;
        });

        $this->middleware->terminate($request);
    }

    public function testTransientTokenMiddleware()
    {
        $request = Request::create('/', 'POST');


        $request->setUserResolver(function () {
            $user = m::mock();

            $token = m::mock(TransientToken::class.'[]');

            $token->shouldNotReceive('revoke');
            $user->shouldReceive('token')->andReturn($token);
            return $user;
        });

        $this->middleware->terminate($request);
    }
}