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
                call_user_func([Scopes\Overlaps::class, 'scope'], $builder, $range, $keys);
            }, $boolean);
        });

        Builder::macro('intersects', function (CarbonPeriod $range, $boolean = 'and', $keys = []) {
            return $this->whereNested(function ($builder) use ($range, $keys) {
                call_user_func([Scopes\Intersects::class, 'scope'], $builder, $range, $keys);
            }, $boolean);
        });
    }
}
