<?php

namespace Djl997\BladeShortcuts;

use Djl997\BladeShortcuts\Facades\BladeShortcutsDirectives;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeShortcutsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('boolean', static function ($value): string {
            return BladeShortcutsDirectives::boolean($value);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // ..
    }
}