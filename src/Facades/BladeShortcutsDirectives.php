<?php

namespace Djl997\BladeShortcuts\Facades;

use Illuminate\Support\Facades\Facade;
use Djl997\BladeShortcuts\BladeShortcutsBladeDirectives;

class BladeShortcutsDirectives extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BladeShortcutsBladeDirectives::class;
    }
}