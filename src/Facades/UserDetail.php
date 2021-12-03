<?php

namespace Danielebarbaro\UserDetail\Facades;

use Illuminate\Support\Facades\Facade;
use Danielebarbaro\UserDetail\UserDetail as UserDetailClass;

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
