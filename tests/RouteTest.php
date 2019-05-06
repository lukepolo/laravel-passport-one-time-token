<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Tests;

use Mockery as m;
use Laravel\Passport\Token;
use LukePOLO\LaravelPassportOneTimeToken\Tests\Models\User;

class RouteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUnauthorizedRoute()
    {
        $response = $this->post('oauth/one-time/create');
        $this->assertEquals($response->status(), 302);
    }


    public function testAuthorizedRoute()
    {
        $this->useAuthRoute('oauth/one-time/create');
    }

    private function useAuthRoute($route) {
        $user = m::mock(User::class);
        $token = m::mock(Token::class.'[revoke]');

        $token->shouldReceive('revoke')->andReturns(false);

        $user->shouldReceive('token')->andReturns($token);
        $user->shouldReceive('createToken')->andReturns('token');


        $this->actingAs($user, 'api');
        $response = $this->post($route);

        $this->assertEquals($response->status(), 200);
        $this->assertEquals($response->getContent(), 'token');
    }

}