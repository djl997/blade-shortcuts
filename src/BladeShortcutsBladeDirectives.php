<?php

namespace Djl997\BladeShortcuts;

class BladeShortcutsBladeDirectives
{

    /**
     * Boolean directive
     * 
     * @param  string  $value  boolean value (TRUE "1", "true", "on" and "yes", FALSE "0", "false", "off" and "no")
     *
     * @return string
     */
    public function asset(string $url): string
    {
        return "<?= asset($url); ?>";
    }

    /**
     * Boolean directive
     * 
     * @param  string  $value  boolean value (TRUE "1", "true", "on" and "yes", FALSE "0", "false", "off" and "no")
     *
     * @return string
     */
    public function boolean(string $value): string
    {
        return "<?= json_encode(filter_var($value, FILTER_VALIDATE_BOOLEAN)); ?>";
    }

    /**
     * Config directive
     * 
     * @param  string  $value  key of config file
     *
     * @return string
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
     *
     * @return string
     */
    public function date(string $expression)
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
     * Filesize directive
     * 
     * @param  string  $value  bytes amount to convert
     * @param  string  $size   choose filesize to convert the bytes to, default will fallback to kB
     *
     * @return string
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

    // TODO: datetime
    // TODO: time
    // TODO: month
    // TODO: day
    // TODO: carbon ($value, $format)

    // TODO: html attributes @attributes(['class'=>'bg-blue-400' value => 'I didnt type this']) --> class="bg-blue-400" value="I didnt type this"

}