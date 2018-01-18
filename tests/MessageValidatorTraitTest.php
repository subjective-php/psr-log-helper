<?php

namespace ChadicusTest\Psr\Log;

use Chadicus\Psr\Log\MessageValidatorTrait;

/**
 * @coversDefaultClass \Chadicus\Psr\Log\MessageValidatorTrait
 * @covers ::<private>
 */
final class MessageValidatorTraitTest extends \PHPUnit\Framework\TestCase
{
    use MessageValidatorTrait;

    /**
     * @param mixed $message The message that will validate.
     *
     * @test
     * @covers ::validateMessage
     * @dataProvider provideValidValidateData
     *
     * @return void
     */
    public function validateMessageValid($message)
    {
        $this->assertNull($this->validateMessage($message));
    }

    /**
     * Provides valid messages for testing.
     *
     * @return array
     */
    public function provideValidValidateData()
    {
        return [
            ['a string' => 'the message'],
            ['a boolean' => true],
            ['an int' => 123],
            ['a float' => 12.3],
            ['an object' => new \SplFileInfo(__FILE__)],
        ];
    }

    /**
     * @test
     * @covers ::validateMessage
     * @expectedException \Psr\Log\InvalidArgumentException
     *
     * @return void
     */
    public function validateMessageInvalid()
    {
        $this->validateMessage(new \StdClass());
    }
}
