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

        Blade::directive('dayOfWeek', function ($expression): string {
            return BladeShortcutsDirectives::dayOf($expression, 'd');
        });
        Blade::directive('dayOfMonth', function ($expression): string {
            return BladeShortcutsDirectives::dayOf($expression, 'D');
        });
        Blade::directive('dayOfYear', function ($expression): string {
            return BladeShortcutsDirectives::dayOf($expression, 'DDD');
        });
        
        Blade::directive('cascadeFromMonths', function ($expression): string {
            return BladeShortcutsDirectives::cascade($expression, 'months');
        });
        Blade::directive('cascadeFromDays', function ($expression): string {
            return BladeShortcutsDirectives::cascade($expression, 'days');
        });
        Blade::directive('cascadeFromHours', function ($expression): string {
            return BladeShortcutsDirectives::cascade($expression, 'hours');
        });
        Blade::directive('cascadeFromMinutes', function ($expression): string {
            return BladeShortcutsDirectives::cascade($expression, 'minutes');
        });
        Blade::directive('cascadeFromSeconds', function ($expression): string {
            return BladeShortcutsDirectives::cascade($expression, 'seconds');
        });

        /**
         * Safe nl2br
         */
        Blade::directive('nl2br', function ($expression): string {
            return BladeShortcutsDirectives::nl2br($expression);
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

        Blade::directive('notSet', function ($expression): string {
            return BladeShortcutsDirectives::notSet($expression);
        });
        Blade::directive('endNotSet', function (): string {
            return BladeShortcutsDirectives::end();
        });

        // notIsset is renamed to notSet, keeping the old name as an alias
        Blade::directive('notIsset', function ($expression): string {
            return BladeShortcutsDirectives::notSet($expression);
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