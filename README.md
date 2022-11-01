# Blade Shortcuts

Blade Shortcuts is a library of handy Blade Directives.

## Installation
```
composer require djl997/blade-shortcuts
```

## Usage

### Boolean
```blade
@boolean(true) <!-- true -->
@boolean(false) <!-- false -->
```

### Filesize
```blade
@filesize(2145) <!-- 2 kB -->
@filesizemb(124588) <!-- <1 MB -->
@filesizegb(1198466000) <!-- 1,1 GB -->
```