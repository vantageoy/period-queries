<?php

namespace Vantage\PeriodQueries;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class PeriodQueriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Builder::macro('overlaps', function ($range, $boolean = 'and', $keys = []) {
            return $this->whereNested(function ($builder) use ($range, $keys) {
                Scopes\Overlaps::scope($builder, $range, $keys);
            }, $boolean);
        });

        Builder::macro('intersects', function ($range, $boolean = 'and', $keys = []) {
            return $this->whereNested(function ($builder) use ($range, $keys) {
                Scopes\Intersects::scope($builder, $range, $keys);
            }, $boolean);
        });

        Builder::macro('orOverlaps', function ($range, $keys = []) {
            return $this->overlaps($range, 'or', $keys);
        });

        Builder::macro('orIntersects', function ($range, $keys = []) {
            return $this->intersects($range, 'or', $keys);
        });
    }
}
