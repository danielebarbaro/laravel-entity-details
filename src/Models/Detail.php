<?php

namespace Danielebarbaro\EntityDetail\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        $this->setTable(config('entity-details.table_name'));
        parent::__construct($attributes);
    }

    public function owner(): MorphTo
    {
        $relation = $this->morphTo(__FUNCTION__, 'owner_type', 'owner_id');
        if (config('entity-details.returns_soft_deleted_models')) {
            /** @phpstan-ignore-next-line */
            return $relation->withTrashed();
        }

        return $relation;
    }

    public function scopeForOwner(Builder $query, Model $owner): Builder
    {
        return $query
            ->where('owner_type', $owner->getMorphClass())
            ->where('owner_id', $owner->getKey());
    }

    public function scopeIsCompany(Builder $query): Builder
    {
        return $query
            ->where('is_company', true);
    }
}
