<?php

namespace Vantage\PeriodQueries\Scopes;

use Illuminate\Database\Query\Builder;

class Overlaps extends Scope
{
    /**
     * Scope the query to only include results overlapping the given range.
     * 
     * @static
     * @param  \Illuminate\Database\Query\Builder  $builder
     * @param  \DatePeriod|\Carbon\CarbonPeriod  $period
     * @param  array  $keys  ['startKey', 'endKey']
     * @return void
     */
    public static function scope(Builder $builder, $range, array $keys = [])
    {
        list($startKey, $endKey) = static::keys($keys);

        $start = $range->getStartDate();
        $end = $range->getEndDate();

        // Starts in the range.
        $builder->where($startKey, '>', $start)
                ->where($startKey, '<', $end);

        // Ends in the range
        $builder->orWhere($endKey, '>', $start)
                ->where($endKey, '<', $end);

        // Contains the range
        $builder->orWhere($startKey, '<=', $start)
                ->where($endKey, '>=', $end);
    }
}
