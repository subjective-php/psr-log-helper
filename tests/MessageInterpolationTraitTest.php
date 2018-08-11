<?php

namespace SubjectivePHPTest\Psr\Log;

use SubjectivePHP\Psr\Log\MessageInterpolationTrait;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\MessageInterpolationTrait
 * @covers ::<private>
 */
final class MessageInterpolationTraitTest extends \PHPUnit\Framework\TestCase
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
