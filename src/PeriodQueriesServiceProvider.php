<?php

namespace Vantage\PeriodQueries;

use Carbon\CarbonPeriod;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class PeriodQueriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Builder::macro('overlaps', function (CarbonPeriod $range, $boolean = 'and', $keys = []) {
            return $this->whereNested(function ($builder) use ($range, $keys) {
                Scopes\Overlaps::scope($builder, $range, $keys);
            }, $boolean);
        });

        Builder::macro('intersects', function (CarbonPeriod $range, $boolean = 'and', $keys = []) {
            return $this->whereNested(function ($builder) use ($range, $keys) {
                Scopes\Intersects::scope($builder, $range, $keys);
            }, $boolean);
        });
    }
}
