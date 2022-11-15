<?php

namespace Djl997\BladeShortcuts;

class Parser
{
    /**
     * Parse expression.
     *
     * @param  string  $expression
     * @return array
     */
    public static function multipleArgs($expression): array
    {
        return collect(explode(',', $expression))->map(function ($item) {
            return trim($item);
        })->toArray();
    }

    /**
     * Strip quotes.
     *
     * @param  string  $expression
     * @return string
     */
    public static function stripQuotes($expression): string
    {
        return str_replace(["'", '"'], '', $expression);
    }
}