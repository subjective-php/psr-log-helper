<?php

namespace SubjectivePHP\Psr\Log;

use Psr\Log\InvalidArgumentException;

/**
 * Trait for extracting the exception value from context for PSR-3 log messages.
 */
trait ExceptionExtractorTrait
{
    /**
     * Extracts and returns the exception value from the given context.
     *
     * @param array $context Any extraneous log information that does not fit well in a string.
     *
     * @return \Exception|null
     */
    protected function getExceptionFromContext(array $context)
    {
        $exception = $context['exception'] ?? null;

        if ($exception instanceof \Exception) {
            return $exception;
        }

        if ($exception instanceof \Error) {
            return new \ErrorException(
                $exception->getMessage(),
                0,
                $exception->getCode(),
                $exception->getFile(),
                $exception->getLine()
            );
        }

        return null;
    }
}
