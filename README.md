# Blade Shortcuts

[![Latest Version on Packagist](https://img.shields.io/packagist/v/djl997/blade-shortcuts.svg?style=flat-square)](https://packagist.org/packages/djl997/blade-shortcuts)
[![Total Downloads](https://img.shields.io/packagist/dt/djl997/blade-shortcuts.svg?style=flat-square)](https://packagist.org/packages/djl997/blade-shortcuts)
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
- [Boolean](#boolean)
- [Config](#config)
- [Dates](#dates)
    - date
    - datetime
    - time
    - year
    - month
    - day
- [Filesizes](#filesize)
- [Not empty](#not-empty-inverse-of-empty)
- [Not isset](#not-isset-inverse-of-isset)
- [Percentage](#percentage)
- Helpers
    - [Arrays](#arrays)
    - [Fluent Strings](#fluent-strings)

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
Automatically translate dates in the correct localized format (currently only EN, NL, DE supported):
- EN: November 8, 2022
- NL: 8 november 2022
- DE: 8. November 2022

```blade
@date(time()) <!-- November 8, 2022 -->
@date(date('Y-m-d')) <!-- November 8, 2022 -->
```

Other options:
```blade
@date(now()->subHours(20)) <!-- November 14, 2022 -->
@date(now()->subHours(20), 'dateOrDiff') <!-- 20 hours ago -->
@date(now()->subWeek()) <!-- November 8, 2022 -->
@date(now()->subWeek(), 'dateOrDiff') <!-- November 8, 2022 -->
```
> If the time difference is more than 23 hours, ‘dateOrDiff’ will automatically show the date in a localized format instead of ‘x time ago’ or ‘in x time’. You can adjust this threshold in the config file: `php artisan vendor:publish --tag=blade-shortcuts-config`. 

Try shortcuts for datetime, time, year, month or day (also in the correct localized format):
```blade
@datetime(now()) <!-- November 8, 2022 3:04 PM -->
@time(now()) <!-- 3:04 PM -->

@year(now()) <!-- 2022 -->
@month(now()) <!-- November -->
@day(now()) <!-- Tuesday -->
```

### Filesize
```blade
@filesize(2145) <!-- 2 kB -->
@filesizemb(124588) <!-- <1 MB -->
@filesizegb(1198466000) <!-- 1,1 GB -->
```

### Not Empty, inverse of @empty
```blade
@notEmpty(1)
    I'm not empty.
@endNotEmpty
```

### Not Isset, inverse of @isset
```blade
@notIsset($notSetVariable)
    I'm not set.
@endNotIsset
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

## Helpers

### Arrays
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

### Fluent strings
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