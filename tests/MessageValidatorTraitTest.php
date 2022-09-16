<?php

namespace SubjectivePHPTest\Psr\Log;

use SubjectivePHP\Psr\Log\MessageValidatorTrait;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\MessageValidatorTrait
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
     *
     * @return void
     */
    public function validateMessageInvalid()
    {
        $this->expectException(\Psr\Log\InvalidArgumentException::class);
        $this->validateMessage(new \StdClass());
    }
}
