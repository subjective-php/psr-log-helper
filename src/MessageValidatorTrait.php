<?php

namespace SubjectivePHP\Psr\Log;

use Psr\Log\InvalidArgumentException;

/**
 * Trait for validating PSR-3 log messages.
 */
trait MessageValidatorTrait
{
    /**
     * Determines if the specified message is legal under PSR-3.
     *
     * @param mixed $message The message to validate.
     *
     * @return void
     *
     * @throws InvalidArgumentException Throw if $message is not a know RFC-5424 message.
     */
    protected function validateMessage($message)
    {
        if (is_scalar($message)) {
            return;
        }

        if (is_object($message) && method_exists($message, '__toString')) {
            return;
        }

        throw new InvalidArgumentException('Given $message was a valid string value');
    }
}
