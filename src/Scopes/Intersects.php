<?php

namespace Vantage\PeriodQueries\Scopes;

use Illuminate\Database\Query\Builder;

class Intersects extends Scope
{
    /**
     * Scope the query to only include results intersecting the given range.
     * 
     * @static
     * @param  \Illuminate\Database\Query\Builder  $builder
     * @param  \DatePeriod|\Carbon\CarbonPeriod  $period
     * @param  array  $keys  ['startKey', 'endKey']
     * @return void
     */
    public static function scope(Builder $builder, $period, array $keys = []): void
    {
        list($startKey, $endKey) = static::keys($keys);

        $builder->overlaps($period, $keys)
                ->orWhere($endKey, $period->getStartDate())
                ->orWhere($startKey, $period->getEndDate());
    }
}
