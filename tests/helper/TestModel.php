<?php

namespace Danielebarbaro\EntityDetail\Tests\helper;

use Danielebarbaro\EntityDetail\Traits\EntityDetail;
use Danielebarbaro\EntityDetail\Traits\EntityDetailHydrate;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use EntityDetail;
    use EntityDetailHydrate;

    public $table = 'test_models';

    protected $guarded = [];

    public $timestamps = false;
}
