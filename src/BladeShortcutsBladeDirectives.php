<?php

namespace Djl997\BladeShortcuts;

class BladeShortcutsBladeDirectives
{
    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var($value, FILTER_VALIDATE_BOOLEAN)); ?>";
    }

    public function filesize(string $value, string $size = 'kB'): string
    {
        switch ($size) {
            case 'MB':
                return "<?php echo (($value / 1048576) < 1 ? '&lt;1' : number_format($value/ 1048576, 0, ',', '.')) . ' MB'; ?>";
                break;

            case 'GB':
                return "<?php echo number_format($value/ 1073741824, 1, ',', '.') . ' GB'; ?>";
                break;
            
            default:
                return "<?php echo number_format($value/ 1024, 0, ',', '.') . ' kB'; ?>";
                break;
        }        
    }

}