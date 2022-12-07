# Blade Shortcuts

[![Latest Version on Packagist](https://img.shields.io/packagist/v/djl997/blade-shortcuts.svg?style=flat-square)](https://packagist.org/packages/djl997/blade-shortcuts)
[![Total Downloads](https://img.shields.io/packagist/dt/djl997/blade-shortcuts.svg?style=flat-square)](https://packagist.org/packages/djl997/blade-shortcuts)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Blade Shortcuts is a library of handy Blade Directives as listed below.

## Requirements
Blade Shortcuts requires PHP 8+ and Laravel 6+.

## Installation
You can install the package via composer:
```bash
composer require djl997/blade-shortcuts
```

## Usage
After installation all blade directives should be usable. Try running `php artisan view:clear` if the directives are not working properly or if they are not updating. 

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


### Date
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

@date(null)
@date('')
@date(0)
```

### Filesize
```blade
@filesize(2145) <!-- 2 kB -->
@filesizemb(124588) <!-- <1 MB -->
@filesizegb(1198466000) <!-- 1,1 GB -->
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are welcome.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.