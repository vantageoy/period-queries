<?php

namespace Vantage\PeriodQueries\Scopes;

use Carbon\CarbonPeriod;
use Illuminate\Database\Query\Builder;

class Overlaps
{
    /**
     * Scope the query to only include results overlapping the given range.
     */
    public static function scope(Builder $builder, CarbonPeriod $range, array $keys = [])
    {
        list($start, $end) = count($keys) !== 2 ? ['started_at', 'ended_at'] : $keys;

        // Starts in the range.
        $builder->where($start, '>', $range->getStartDate())
                ->where($start, '<', $range->getEndDate());

        // Ends in the range
        $builder->orWhere($end, '>', $range->getStartDate())
                ->where($end, '<', $range->getEndDate());

        // Contains the range
        $builder->orWhere($start, '<=', $range->getStartDate())
                ->where($end, '>=', $range->getEndDate());
    }
}
