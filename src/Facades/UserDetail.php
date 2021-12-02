<?php

namespace Danielebarbaro\UserDetail\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Danielebarbaro\UserDetail\UserDetail
 */
class UserDetail extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-user-details';
    }
}
