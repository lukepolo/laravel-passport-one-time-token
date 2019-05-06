<?php

namespace LukePOLO\LaravelPassportOneTimeToken\Tests\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use HasApiTokens;

}
