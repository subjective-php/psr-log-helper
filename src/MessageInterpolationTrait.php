<?php

namespace Chadicus\Psr\Log;

/**
 * Trait for PSR-3 Message Interpolation.
 */
trait MessageInterpolationTrait
{
    /**
     * Interpolates context values into the message placeholders.
     *
     * @link https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md#12-message
     *
     * @param string $message The string containing the placeholders.
     * @param array  $context The key/value array of replacement values.
     *
     * @return string
     */
    protected function interpolateMessage($message, array $context)//@codingStandardsIgnoreLine Ignore missing type hint
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
