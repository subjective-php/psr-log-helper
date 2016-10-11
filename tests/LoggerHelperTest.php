<?php

namespace ChadicusTest\Psr\Log;

use Chadicus\Psr\Log\LoggerHelper;

/**
 * @coversDefaultClass Chadicus\Psr\Log\LoggerHelper
 */
final class LoggerHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Verify basic behavior of interpolateMessage().
     *
     * @test
     * @covers ::interpolateMessage
     *
     * @return void
     */
    public function interpolateMessage()
    {
        $message = 'The {0} brown {1} jumped over the {3} {1}';
        $context = [
            'quick',
            'fox',
            new \StdClass(), //not usable as replacement will be skipped
            'lazy',
        ];

        $this->assertSame(
            'The quick brown fox jumped over the lazy fox',
            LoggerHelper::interpolateMessage($message, $context)
        );
    }

    /**
     * Verify behavior of validateLevel() with invalid level.
     *
     * @test
     * @covers ::validateLevel
     * @expectedException \Psr\Log\InvalidArgumentException
     * @expectedExceptionMessage Given $level was not a known LogLevel
     *
     * @return void
     */
    public function validateLevelInvalid()
    {
    	LoggerHelper::validateLevel('invalid');
    }

    /**
     * Verify behavior of validateLevel() with valid level.
     *
     * @test
     * @covers ::validateLevel
     *
     * @return void
     */
    public function validateLevelValid()
    {
    	$this->assertNull(LoggerHelper::validateLevel('info'));
    }
}
