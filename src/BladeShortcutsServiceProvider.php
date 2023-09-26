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

        $this->publishes([
            __DIR__.'/../config/blade-shortcuts.php' => config_path('blade-shortcuts.php'),
        ], 'blade-shortcuts-config');
        
        /**
         * Config
         */
        Blade::directive('appname', function (): string {
            return BladeShortcutsDirectives::config('app.name');
        });
        Blade::directive('config', function ($expression): string {
            return BladeShortcutsDirectives::config($expression);
        });

        /**
         * Filesizes
         */
        Blade::directive('asset', function ($expression): string {
            return BladeShortcutsDirectives::asset($expression);
        });
        Blade::directive('boolean', function ($value): string {
            return BladeShortcutsDirectives::boolean($value);
        });

        /**
         * Dates
         */
        Blade::directive('carbon', function ($expression): string {
            return BladeShortcutsDirectives::carbon($expression);
        });
        Blade::directive('date', function ($expression): string {
            return BladeShortcutsDirectives::date($expression);
        });
        Blade::directive('datetime', function ($expression): string {
            return BladeShortcutsDirectives::datetime($expression);
        });
        Blade::directive('year', function ($expression): string {
            return BladeShortcutsDirectives::year($expression);
        });
        Blade::directive('month', function ($expression): string {
            return BladeShortcutsDirectives::month($expression);
        });
        Blade::directive('day', function ($expression): string {
            return BladeShortcutsDirectives::day($expression);
        });
        Blade::directive('time', function ($expression): string {
            return BladeShortcutsDirectives::time($expression);
        });
        Blade::directive('readableMinutes', function ($expression): string {
            return BladeShortcutsDirectives::readableMinutes($expression);
        });

        /**
         * Filesizes
         */
        Blade::directive('filesize', function ($expression): string {
            return BladeShortcutsDirectives::filesize($expression);
        });
        Blade::directive('filesizemb', function ($expression): string {
            return BladeShortcutsDirectives::filesize($expression, 'MB');
        });
        Blade::directive('filesizegb', function ($expression): string {
            return BladeShortcutsDirectives::filesize($expression, 'GB');
        });

        /**
         * Extensions to vanilla directives
         */
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

        /**
         * Financial
         */
        Blade::directive('percentage', function ($expression): string {
            return BladeShortcutsDirectives::percentage($expression);
        });

        /**
         * Helpers
         */
        Blade::directive('str', function ($expression): string {
            return BladeShortcutsDirectives::str($expression);
        });
        Blade::directive('arr', function ($expression): string {
            return BladeShortcutsDirectives::arr($expression);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/blade-shortcuts.php', 'blade-shortcuts'
        );
    }
}