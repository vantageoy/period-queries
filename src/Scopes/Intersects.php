<?php

namespace Vantage\PeriodQueries\Scopes;

use Carbon\CarbonPeriod;
use Illuminate\Database\Query\Builder;

class Intersects
{
    /**
     * Scope the query to only include results intersecting the given range.
     */
    public static function scope(Builder $builder, CarbonPeriod $range, array $keys = [])
    {
        list($start, $end) = count($keys) !== 2 ? ['started_at', 'ended_at'] : $keys;

        $builder->overlaps($range, 'and', $keys)
                ->orWhere($end, $range->getStartDate())
                ->orWhere($start, $range->getEndDate());
    }
}
