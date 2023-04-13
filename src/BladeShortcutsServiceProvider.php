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
        
        Blade::directive('appname', function (): string {
            return BladeShortcutsDirectives::config('app.name');
        });

        Blade::directive('asset', function ($expression): string {
            return BladeShortcutsDirectives::asset($expression);
        });

        Blade::directive('boolean', function ($value): string {
            return BladeShortcutsDirectives::boolean($value);
        });

        Blade::directive('config', function ($expression): string {
            return BladeShortcutsDirectives::config($expression);
        });

        Blade::directive('date', function ($expression): string {
            return BladeShortcutsDirectives::date($expression);
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

        Blade::directive('notEmpty', function ($expression): string {
            return BladeShortcutsDirectives::notEmpty($expression);
        });
        Blade::directive('endNotEmpty', function (): string {
            return BladeShortcutsDirectives::end();
        });

        Blade::directive('notIsset', function ($expression): string {
            return BladeShortcutsDirectives::notIsset($expression);
        });
        Blade::directive('endNotIsset', function (): string {
            return BladeShortcutsDirectives::end();
        });

        Blade::directive('percentage', function ($expression): string {
            return BladeShortcutsDirectives::percentage($expression);
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