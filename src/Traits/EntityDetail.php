<?php

namespace Danielebarbaro\EntityDetail\Traits;

use Danielebarbaro\EntityDetail\Models\Detail;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait EntityDetail
{
    public function detail(): MorphOne
    {
        return $this->morphOne(
            Detail::class,
            'owner',
        );
    }
}
