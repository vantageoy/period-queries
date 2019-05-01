<?php

namespace Vantage\PeriodQueries\Scopes;

use Illuminate\Database\Query\Builder;

abstract class Scope
{
    /**
     * Verify the given period column keys.
     * 
     * @param  array  $keys  ['startKey', 'endKey']
     * @return array
     */
    public static function keys(array $keys = []): array
    {
        if (count($keys) === 2) {
            return $keys;
        }
        
        return ['started_at', 'ended_at'];
    }
}
