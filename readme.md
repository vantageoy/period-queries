# Laravel period queries

Adds `overlaps` and `intersects` macros to your Laravel `QueryBuilder`.

![Period relations](https://github.com/vantageoy/period-queries/blob/master/PeriodRelations.png)

## Installation

Just `composer require vantageoy/period-queries`

## Usage

```php
<?php

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = ['started_at', 'ended_at'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['started_at', 'ended_at'];
}
```

```php
use Carbon\CarbonPeriod;

$period = CarbonPeriod::create('2019-01-01', '2019-01-31');

Event::overlaps($period);
```

```php
$start = new DateTime(2019, 1, 1);
$end = new DateTime(2019, 1, 31);
$period = new DatePeriod($start, 'P1D', $end);

Event::intersects($period);
```

### Advanced

```php
Event::whereTitle($title)->orOverlaps($period);
```

```php
Event::whereTitle($title)->orIntersects($period);
```

```php
Event::overlaps($period, ['created_at', 'updated_at']);
```

## Contributing

1. `composer install`
2. `./vendor/bin/phpunit`
