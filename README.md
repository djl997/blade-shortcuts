# Blade Shortcuts

[![Latest Version on Packagist](https://img.shields.io/packagist/v/djl997/blade-shortcuts.svg?style=flat-square)](https://packagist.org/packages/djl997/blade-shortcuts)
[![Total Downloads](https://img.shields.io/packagist/dt/djl997/blade-shortcuts.svg?style=flat-square)](https://packagist.org/packages/djl997/blade-shortcuts)
![Build Status](https://img.shields.io/github/actions/workflow/status/djl997/blade-shortcuts/phpunit.yml?label=tests&style=flat-square&branch=main)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Blade Shortcuts is a library of clever Blade Directives as listed below. The goal is to have less repetitive (base) logic in your Blade Views, overall shorter code and better readability.

## Requirements
Blade Shortcuts requires PHP 8+ and Laravel 6+.

## Installation
You can install the package via composer:
```sh
composer require djl997/blade-shortcuts
```

## Usage
After installation, all directives should be usable immediately. If something goes wrong at first use or after an update, `php artisan view:clear` should clear the issue. 

## Contents
- [App Name](#app-name)
- [Arrays](#arrays)
- [Boolean](#boolean)
- [Config](#config)
- [Dates](#dates)
    - date, datetime, time, year, month, day
    - [dayOf](#day-of-week-day-of-month-day-of-year)
        - dayOfWeek
        - dayOfMonth
        - dayOfYear
    - [cascades](#carbon-cascades)
        - cascadeFromMinutes
        - cascadeFromHours
        - cascadeFromDays
        - cascadeFromWeeks
        - cascadeFromMonths
- [Filesizes](#filesize)
- [Fluent Strings](#fluent-strings)
- [Money](#money)
- [Nl2br](#nl2br)
- [Not empty](#not-empty-inverse-of-empty)
- [Not isset](#not-isset-inverse-of-isset)
- [Percentage](#percentage)

### App Name
```blade
@appname <!-- Laravel, default APP_NAME in .env file -->
```

### Boolean
```blade
@boolean(true) <!-- true -->
@boolean(false) <!-- false -->
```

### Config
```blade
@config('config-file.key') <!-- anything -->
```


### Dates
Automatically translate dates in the correct localized format (currently only EN, NL, DE, ES supported).

```blade
@date() <!-- February 8, 2024 -->
@date(time()) <!-- February 8, 2024 -->
@date(date('Y-m-d')) <!-- February 8, 2024 -->
```

Other options:
```blade
@date(now()->subHours(20)) <!-- February 14, 2024 -->
@date(now()->subHours(20), 'dateOrDiff') <!-- 20 hours ago -->
@date(now()->subWeek()) <!-- February 8, 2024 -->
@date(now()->subWeek(), 'dateOrDiff') <!-- February 8, 2024 -->
```
> If the time difference is more than 23 hours, ‘dateOrDiff’ will automatically show the date in a localized format instead of ‘x time ago’ or ‘in x time’. You can adjust this threshold in the config file: `php artisan vendor:publish --tag=blade-shortcuts-config`. 

Try shortcuts for datetime, time, year, month or day (also in the correct localized format):
```blade
@datetime <!-- February 8, 2024 3:04 PM -->
@time <!-- 3:04 PM -->
@year <!-- 2024 -->
@month <!-- February -->
@day <!-- Tuesday -->
```

You even can add a custom date to datetime, time, year, month or day, for example:
```blade
@day(now()) <!-- Thursday -->
@year('2024-02-08')  <!-- 2024 -->
```

#### Day of Week, Day of Month, Day of Year
In some cases you need the _x_ day of week, month or year.

```blade
@dayOfYear <!-- 177 -->
@dayOfMonth <!-- 25 -->
@dayOfWeek <!-- 2 -->
```

Or generate it based on a value:
```blade
@dayOfWeek('2024-06-25') <!-- 2 -->
@dayOfWeek(now()->subDay()) <!-- 1 -->
@dayOfYear($user->updated_at) <!-- 177 -->
```

#### Carbon Cascades
If you want to display a certain amount of time in human readable format, try out the new cascade directives. For example, convert 125 minutes to a readable format:
```blade
@cascadeFromMinutes(125) <!-- 2h 5m -->
@cascadeFromHours(146) <!-- 6d 2h -->
```

##### Change the time unit
If you set the time unit (2nd item in the array), the cascade will cascade max to the given unit. In the example below, we have 1530 minutes, divided into hours of 60 minutes:
```blade
@cascadeFromMinutes(1530) <!-- 1d 1h 30m -->
@cascadeFromMinutes([1530, ['hour' => 60]]) <!-- 25h 30m, (Please notice the use of an array!) -->
```

##### CarbonInterval
The example above also means you can tweak the [CarbonInterval](https://carbon.nesbot.com/docs/#api-interval). Suppose you have a project that requires 125 hours of work and you can allocate 30 hours per day for it. How many days will it take to complete the project? We use the `@cascadeFromHours` directive to calculate this value:
```blade
@cascadeFromHours([125, ['day' => 30]]) <!-- 4d 5h -->
```


### Filesize
```blade
@filesize(2145) <!-- 2 kB -->
@filesizemb(124588) <!-- <1 MB -->
@filesizegb(1198466000) <!-- 1,1 GB -->
```

### nl2br
How to display input from a `textarea` in a read-only situation? Maybe you use `{!! $comment !!}` to get unexcaped data. In this way, you loose the XSS prevention, so maybe you sacrifice the newlines if the risk is too high. Now, that is no longer necessary: use the `@nl2br` directive.
```blade
@nl2br('Your view will show newlines.\n\n Very intuitive.') 
<!-- 
Your view will show newlines.

Very intuitive.
-->

@nl2br('Your possible unsafe HTML code <script>alert('Hello world')</script>\n will not execute.')
<!-- 
Your possible unsafe HTML code <script>alert('Hello world')</script>
will not execute.
-->
```

### Not Empty, inverse of @empty
```blade
@notEmpty(1)
    I'm not empty.
@endNotEmpty
```

### Not set, inverse of @isset
```blade
@notSet($notSetVariable)
    I'm not set.
@endNotSet
```

### Percentages
```blade
@percentage(1) <!-- 100% -->
@percentage(0.055) <!-- 5.5% -->
@percentage(100) <!-- 100% -->
@percentage(50) <!-- 50% -->
@percentage(0.5) <!-- 50% -->
@percentage(0.505) <!-- 50.5% -->
@percentage(-5) <!-- -5% -->
```

### Simple Money
```blade
@simpleMoney() <!-- €0.00  -->
@simpleMoney(.99) <!-- €0.99  -->
@simpleMoney(112327.20) <!-- €112,327.20  -->
@simpleMoney(112327.20, 'JPY') <!-- ¥112,327.20  -->
@simpleMoney(112327.20, 'USD', 'es') <!-- 112.327,20 US$  -->
```

### Helpers

#### Arrays
```blade
<?php $array = ['Tailwind', 'Alpine', 'Laravel', 'Livewire']; ?>

<!-- Before -->
{{ Illuminate\Support\Arr::join($array, ', ', ' and ') }}

<!-- After -->
@arr(join($array, ', ', ' and '))  

<!-- Result -->
Tailwind, Alpine, Laravel and Livewire
```
Find all available methods in [Laravel Docs](https://laravel.com/docs/10.x/helpers#arrays-and-objects-method-list).

#### Fluent strings
```blade
<!-- Before -->
{{ Illuminate\Support\Str::of('    laravel    framework    ')->squish() }}

<!-- After -->
@str(of('    laravel    framework    ')->squish())  

<!-- Result  -->
laravel framework
```
Find all available methods in [Laravel Docs](https://laravel.com/docs/10.x/helpers#fluent-strings-method-list).

## Publish config
```sh
php artisan vendor:publish --tag=blade-shortcuts-config
```

## Changelog
Please see [GitHubs releases section](https://github.com/djl997/blade-shortcuts/releases) for more information on what has changed recently.

## Contributing

Contributions are welcome.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
