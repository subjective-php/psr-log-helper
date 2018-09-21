<?php

namespace SubjectivePHP\Psr\Log;

use ArrayObject;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * PSR-3 Logger implementation writing to an array.
 */
final class InMemoryLogger extends AbstractLogger implements LoggerInterface
{
    use MessageInterpolationTrait;

    /**
     * @var ArrayObject
     */
    private $logs;

    /**
     * Construct a new instance of the logger.
     *
     * @param ArrayObject $logs Container for log entries.
     */
    public function __construct(ArrayObject $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param string $level   A valid RFC-5424 log level.
     * @param string $message The base log message.
     * @param array  $context Any extraneous information that does not fit well in a string.
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->logs[] = [
            'level' => $level,
            'message' => $this->interpolateMessage($message, $context),
            'context' => $context,
        ];
    }
}
