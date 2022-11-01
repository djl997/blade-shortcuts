<?php

namespace Djl997\BladeShortcuts\Facades;

use Illuminate\Support\Facades\Facade;
use Djl997\BladeShortcuts\BladeShortcutsBladeDirectives;

/**
 * @method static string styles(bool $absolute = true)
 * @method static string|null getManifestVersion(string $file, ?string &$route = null)
 */
class BladeShortcutsDirectives extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BladeShortcutsBladeDirectives::class;
    }
}