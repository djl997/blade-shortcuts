<?php

namespace Djl997\BladeShortcuts;

class BladeShortcutsBladeDirectives
{

    /**
     * Boolean directive
     * 
     * @param  string  $value  boolean value (TRUE "1", "true", "on" and "yes", FALSE "0", "false", "off" and "no")
     */
    public function asset(string $url): string
    {
        return "<?= asset($url); ?>";
    }

    /**
     * Boolean directive
     * 
     * @param  string  $value  boolean value (TRUE "1", "true", "on" and "yes", FALSE "0", "false", "off" and "no")
     */
    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var($value, FILTER_VALIDATE_BOOLEAN)); ?>";
    }

    /**
     * Convert any date or time supported by the carbon package. 
     * 
     * @param  $expression  containing two arguments: 1. date or time, 2. format
     * 
     * @return string  
     */
    public function carbon(string $expression): string
    {
        $arr = Parser::multipleArgs($expression);

        $return = "<?php echo empty($arr[0]) ? '' : ";
        $return .= "\Carbon\Carbon::parse($arr[0])";

        if(isset($arr[1])) {
            $arr[1] = Parser::stripQuotes($arr[1]);
            $return .= "->translatedFormat('$arr[1]')";
        }

        $return .= "; ?>";

        return $return;        
    }

    /**
     * Config directive
     * 
     * @param  string  $value  key of config file
     */
    public function config(string $expression): string
    {
        $expression = Parser::stripQuotes($expression);

        if(is_array(config($expression))) {
            return "<?= json_encode(config('$expression')) ?>";
        } else {
            return "<?= config('$expression') ?>";
        }
    }

    /**
     * Local formatted date directive
     * 
     * @param  string  $value  
     */
    public function date(string $expression): string
    {
        $arr = Parser::multipleArgs($expression);
            
        if(count($arr) === 2) {
            switch ($arr[1]) {
                case "'dateOrDiff'":
                    return "<?php if(!empty($arr[0])) { if(\Carbon\Carbon::parse($arr[0])->diffInHours() > 23) { echo Carbon\Carbon::parse($arr[0])->translatedFormat(__('blade_directives::format.date')); } else { echo Carbon\Carbon::parse($arr[0])->diffForHumans(['options' => Carbon\Carbon::ONE_DAY_WORDS]); } } else { echo ''; } ?>";
                    break;

                default:
                    return "<?php echo empty($expression) ? '' : \Carbon\Carbon::parse($expression)->translatedFormat(__('blade_directives::format.date')); ?>";
                    break;
            }
        }

        return "<?php echo empty($expression) ? '' : \Carbon\Carbon::parse($expression)->translatedFormat(__('blade_directives::format.date')); ?>";
    }

    /**
     * Convert date to local format of date and time
     * 
     * @param  string  $date  
     */
    public function datetime(string $date): string 
    {
        return "<?php echo empty($date) ? '' : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.datetime')); ?>";
    }

    /**
     * Convert date to localized month (full)
     * 
     * @param  string  $date  
     */
    public function year(string $date): string 
    {
        return "<?php echo empty($date) ? '' : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.year')); ?>";
    }

    /**
     * Convert date to localized month (full)
     * 
     * @param  string  $date  
     */
    public function month(string $date): string 
    {
        return "<?php echo empty($date) ? '' : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.month')); ?>";
    }

    /**
     * Convert date to localized day
     * 
     * @param  string  $date  
     */
    public function day(string $date): string 
    {
        return "<?php echo empty($date) ? '' : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.day')); ?>";
    }

    /**
     * Convert date to local timeformat
     * 
     * @param  string  $date  
     */
    public function time(string $date): string 
    {
        return "<?php echo empty($date) ? '' : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.time')); ?>";
    }

    /**
     * Filesize directive
     * 
     * @param  string  $value  bytes amount to convert
     * @param  string  $size   choose filesize to convert the bytes to, default will fallback to kB
     */
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

    /**
     * Inverse directive of vanilla @empty directive
     * 
     * @param  string  $value  bytes amount to convert
     * 
     * @return string
     */
    public function notEmpty(string $value): string
    {
        return "<?php if(!empty($value)): ?>";
    }

    /**
     * Inverse directive of vanilla @isset directive
     * 
     * @param  string  $value  bytes amount to convert
     * 
     * @return string
     */
    public function notIsset(string $value): string
    {
        return "<?php if(!isset($value)): ?>";
    }

    /**
     * 
     * @param  string  $value  value to be converted to percentages. Note! If you are converting non-floats, values equal or less than 1 will be multiplied by 100
     * 
     * @return string
     */
    public function percentage(string $value): string
    {
        return "<?php echo (floatval($value) <= 1 ? floatval($value) * 100 : floatval($value)) . '%'; ?>";
    }

    /**
     * End if
     * 
     * @return string
     */
    public function end(): string
    {
        return "<?php endif; ?>";
    }

}