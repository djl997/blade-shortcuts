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
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'blade_directives');

        Blade::directive('boolean', function ($value): string {
            return BladeShortcutsDirectives::boolean($value);
        });

        Blade::directive('filesize', function ($expression): string {
            return BladeShortcutsDirectives::filesize($expression);
        });
        Blade::directive('filesizemb', function ($expression): string {
            return BladeShortcutsDirectives::filesize($expression, 'MB');
        });
        Blade::directive('filesizegb', function ($expression): string {
            return BladeShortcutsDirectives::filesize($expression, 'GB');
        });

        Blade::directive('date', function ($expression): string {
            return BladeShortcutsDirectives::date($expression);
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