<?php

namespace App\Models\Traits;

use App\Models\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait EntityFilter
{

    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     * @return void
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
