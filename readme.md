# Laravel period queries

## Installation

Only `composer require vantageoy/period-queries`

## Usage

```php
class Event extends Model
{
    protected $dates = ['started_at', 'ended_at'];
    protected $fillable = ['started_at', 'ended_at'];
}
```

```php
use Carbon\CarbonPeriod;

$period = CarbonPeriod::create('2019-01-01', '2019-01-31');

Event::overlaps($period);
```
```php
use DatePeriod;

$start = new DateTime(2019, 1, 1);
$end = new DateTime(2019, 1, 31);
$period = new DatePeriod($start, 'P1D', $end);

Event::intersects($period);
```

## Contributing

1. `composer install`
2. `./vendor/bin/phpunit`
