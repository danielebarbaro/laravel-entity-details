<?php

namespace Danielebarbaro\UserDetail\Facades;

use Danielebarbaro\UserDetail\UserDetail as UserDetailClass;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Danielebarbaro\UserDetail\UserDetail
 */
class UserDetail extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserDetailClass::class;
    }
}
