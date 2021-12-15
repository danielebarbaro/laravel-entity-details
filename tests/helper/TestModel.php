<?php

namespace Danielebarbaro\EntityDetail\Tests\helper;

use Danielebarbaro\EntityDetail\Traits\EntityDetail;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use EntityDetail;

    public $table = 'test_models';

    protected $guarded = [];

    public $timestamps = false;
}
