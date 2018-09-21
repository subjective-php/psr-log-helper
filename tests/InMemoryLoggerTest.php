<?php

namespace SubjectivePHPTest\Psr\Log;

use ArrayObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use SubjectivePHP\Psr\Log\InMemoryLogger;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\InMemoryLogger
 * @covers ::__construct
 */
final class InMeoryLoggerTest extends TestCase
{
    /**
     * @test
     * @covers ::log
     *
     * @return void
     */
    public function logAlertWithMessageInterpolation()
    {
        $exception = new \RuntimeException();
        $logs = new ArrayObject();
        $logger = new InMemoryLogger($logs);
        $logger->alert('logged {count} entries', ['exception' => $exception, 'count' => 1]);
        $this->assertSame(
            [
                [
                    'level' => LogLevel::ALERT,
                    'message' => 'logged 1 entries',
                    'context' => [
                        'exception' => $exception,
                        'count' => 1,
                    ],
                ],
            ],
            $logs->getArrayCopy()
        );
    }
}
