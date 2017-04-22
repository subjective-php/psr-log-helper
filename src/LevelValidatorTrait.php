<?php

namespace Chadicus\Psr\Log;

use Psr\Log\InvalidArgumentException;

/**
 * Trait for validating PSR-3 log levels.
 */
trait LevelValidatorTrait
{
    /**
     * Determines if the specified level is legal under PSR-3.
     *
     * @param mixed $level The level to validate.
     *
     * @return void
     *
     * @throws InvalidArgumentException Throw if $level is not a know RFC-5424 level.
     */
    protected function validateLevel($level)
    {
        if (!is_string($level) || !defined('\\Psr\\Log\\LogLevel::' . strtoupper($level))) {
            throw new InvalidArgumentException('Given $level was not a known LogLevel');
        }
    }
}
