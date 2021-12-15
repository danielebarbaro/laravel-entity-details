<?php

namespace Danielebarbaro\EntityDetail\Traits;

use Danielebarbaro\EntityDetail\Models\Detail;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait EntityDetail
{
    public function detail(): MorphOne
    {
        $relation = $this->morphOne(Detail::class, 'owner');

        if (config('entity-details.returns_soft_deleted_models')) {
            /** @phpstan-ignore-next-line */
            return $relation->withTrashed();
        }

        return $relation;
    }
}
