<?php

namespace Djl997\BladeShortcuts;

class BladeShortcutsBladeDirectives
{
    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var($value, FILTER_VALIDATE_BOOLEAN)); ?>";
    }
}