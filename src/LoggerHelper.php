<?php

namespace Chadicus\Psr\Log;

use Psr\Log\InvalidArgumentException;

/**
 * Abstract utiltity class for assisting with PSR logger tasks.
 */
abstract class LoggerHelper
{
    /**
     * Helper method to ensure a given level is one of the eight known RFC 5424 levels.
     *
     * @param string $level The level to validate.
     *
     * @return void
     *
     * @throws InvalidArgumentException Throw if $level is not a know RFC-5424 level.
     */
    final public static function validateLevel($level)//@codingStandardsIgnoreLine Ignore missing type hints
    {
        if (!is_string($level) || !defined('\\Psr\\Log\\LogLevel::' . strtoupper($level))) {
            throw new InvalidArgumentException('Given $level was not a known LogLevel');
        }
    }

    /**
     * Interpolates context values into the message placeholders.
     *
     * @param string $message The string containing the placeholders.
     * @param array  $context The key/value array of replacement values.
     *
     * @return string
     */
    final public static function interpolateMessage($message, array $context)//@codingStandardsIgnoreLine Ignore missing type hints
    {
        $context = array_filter(
            $context,
            function ($value) {
                return (is_scalar($value) || (is_object($value) && method_exists($value, '__toString')));
            }
        );

        $search = [];
        $replace = [];
        foreach ($context as $key => $value) {
            $search[] = "{{$key}}";
            $replace[] = (string)$value;
        }

        return str_replace($search, $replace, $message);
    }
}
