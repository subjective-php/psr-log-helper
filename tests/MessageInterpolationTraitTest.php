<?php

namespace ChadicusTest\Psr\Log;

use Chadicus\Psr\Log\MessageInterpolationTrait;

/**
 * @coversDefaultClass \Chadicus\Psr\Log\MessageInterpolationTrait
 * @covers ::<private>
 */
final class MessageInterpolationTraitTest extends \PHPUnit_Framework_TestCase
{
    use MessageInterpolationTrait;

    /**
     * Verify basic behavior of interpolateMessage().
     *
     * @test
     * @covers ::interpolateMessage
     *
     * @return void
     */
    public function interpolateMessageBasic()
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
            $this->interpolateMessage($message, $context)
        );
    }
}
