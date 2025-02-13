<?php

namespace Djl997\BladeShortcuts;

use Illuminate\Support\Str;

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

        if (isset($arr[1])) {
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

        if (is_array(config($expression))) {
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
        if ($expression == 'null')
            return "";

        $arr = Parser::multipleArgs($expression);

        if (empty($expression))
            $expression = 'null';

        if (count($arr) === 2) {
            switch ($arr[1]) {
                case "'dateOrDiff'":
                    return "<?php if(is_null($arr[0])) { echo ''; } else { if(!empty($arr[0])) { if(\Carbon\Carbon::parse($arr[0])->diffInHours() > config('blade-shortcuts.dateOrDiff')) { echo Carbon\Carbon::parse($arr[0])->translatedFormat(__('blade_directives::format.date')); } else { echo Carbon\Carbon::parse($arr[0])->diffForHumans(['options' => Carbon\Carbon::ONE_DAY_WORDS]); } } else { echo ''; } } ?>";
                    break;

                default:
                    return "<?php if(is_null($expression)) { echo ''; } else { echo empty($expression) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.date')) : \Carbon\Carbon::parse($expression)->translatedFormat(__('blade_directives::format.date')); } ?>";
                    break;
            }
        }

        return "<?php if(is_null($expression)) { echo ''; } else { echo empty($expression) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.date')) : \Carbon\Carbon::parse($expression)->translatedFormat(__('blade_directives::format.date')); } ?>";
    }

    /**
     * Convert date to local format of date and time
     * 
     * @param  string  $date  
     */
    public function datetime(string $date): string
    {
        if (strtolower($date) == 'null')
        return "";

        if (empty($date))
            $date = '0';

        return "<?php if(is_null($date)) { echo ''; } else { echo empty($date) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.datetime')) : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.datetime')); } ?>";
    }

    /**
     * Convert date to localized month (full)
     * 
     * @param  string  $date  
     */
    public function year(string $date): string
    {
        if (strtolower($date) == 'null')
            return "";

        if (empty($date))
            $date = '0';

        return "<?php if(is_null($date)) { echo ''; } else { echo empty($date) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.year')) : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.year')); } ?>";
    }

    /**
     * Convert date to localized month (full)
     * 
     * @param  string  $date  
     */
    public function month(string $date): string
    {
        if (strtolower($date) == 'null')
            return "";

        if (empty($date))
            $date = '0';

        return "<?php if(is_null($date)) { echo ''; } else { echo empty($date) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.month')) : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.month')); } ?>";
    }

    /**
     * Convert date to localized day
     * 
     * @param  string  $date  
     */
    public function day(string $date): string
    {
        if (strtolower($date) == 'null')
            return "";

        if (empty($date))
            $date = '0';

        return "<?php if(is_null($date)) { echo ''; } else { echo empty($date) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.day')) : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.day')); } ?>";
    }

    /**
     * 
     */
    public function dayOf(string $date, string $code)
    {
        if ($date == 'null')
            return "";

        if (empty($date))
            $date = '0';

        return "<?php if(is_null($date)) { echo ''; } else { echo empty($date) ? \Carbon\Carbon::now()->isoFormat('$code') : \Carbon\Carbon::parse($date)->isoFormat('$code'); } ?>";
    }

    /**
     * Convert date to local timeformat
     * 
     * @param  string  $date  
     */
    public function time(string $date): string
    {
        if (strtolower($date) == 'null')
            return "";

        if (empty($date))
            $date = '0';

        return "<?php if(is_null($date)) { echo ''; } else { echo empty($date) ? \Carbon\Carbon::now()->translatedFormat(__('blade_directives::format.time')) : \Carbon\Carbon::parse($date)->translatedFormat(__('blade_directives::format.time')); } ?>";
    }

    /** 
     * Cascade timeUnit to a human readable format
     * 
     * @param string $expression
     * 
     * @return string
     */
    public function cascade($expression, $timeUnit): string
    {
        return "<?php   
                \$normal = [
                    'year' => 'months',
                    'month' => 'days',
                    'week' => 'days',
                    'day' => 'hours',
                    'hour' => 'minutes',
                    'minute' => 'seconds',
                ]; 
                \$expression = collect(($expression))->map(function (\$item) {
                    if(is_array(\$item)) {
                        return \$item;
                    }
                    return trim(\$item, \"'\");
                })->toArray();
                if(!isset(\$expression[1])) {
                    \$expression[1] = [];
                }
                \$cascades = \Carbon\CarbonInterval::getCascadeFactors();
                \$newfactors = [];
                foreach (\$expression[1] as \$key => \$value) {
                    if(is_numeric(\$key)) {
                        \$value2 = \Carbon\CarbonInterval::getFactor(\$normal[\$value], \$value);
                        \$newfactors[\$value] = [(int)\$value2, \$normal[\$value]];
                        continue;
                    }
                    \$newfactors[\$key] = [(int)\$value, \$normal[\$key]];
                }
                \Carbon\CarbonInterval::setCascadeFactors(\$newfactors);
                echo \Carbon\CarbonInterval::$timeUnit(\$expression[0])->cascade()->forHumans(['options' => 0, 'short' => true]);
                \Carbon\CarbonInterval::setCascadeFactors(\$cascades);
            ?>";
    }

    /**
     * Safe nl2br
     *  
     * @param  string  $value
     */
    public function nl2br(string $value): string
    {
        return "<?php echo nl2br(e($value)); ?>";
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
    public function notSet(string $value): string
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
    public function endIf(): string
    {
        return "<?php endif; ?>";
    }


    /**
     * Fluent strings helper
     */
    public function str($expression): string
    {
        return "<?php echo Illuminate\Support\Str::$expression; ?>";
    }

    /**
     * Arrays helper
     */
    public function arr($expression): string
    {
        return "<?php echo Illuminate\Support\Arr::$expression; ?>";
    }
}
