<?php

namespace SubjectivePHPTest\Psr\Log;

use SubjectivePHP\Psr\Log\ExceptionExtractorTrait;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\ExceptionExtractorTrait
 */
final class ExceptionExtractorTraitTest extends \PHPUnit\Framework\TestCase
{
    use ExceptionExtractorTrait;

    /**
     * @param array  $context         The array containing the exception.
     * @param string $expectedType    The expected exception class.
     * @param string $expectedMessage The expected exception message.
     *
     * @test
     * @covers ::getExceptionFromContext
     * @dataProvider provideDataWithException
     *
     * @return void
     */
    public function getException(array $context, string $expectedType, string $expectedMessage)
    {
        $exception = $this->getExceptionFromContext($context);
        $this->assertInstanceOf($expectedType, $exception);
        $this->assertSame($expectedMessage, $exception->getMessage());
    }

    /**
     * @param array $context The array which does not contain a valid exception
     *
     * @test
     * @covers ::getExceptionFromContext
     * @dataProvider provideDataWithoutException
     *
     * @return void
     */
    public function getNull(array $context)
    {
        $this->assertNull($this->getExceptionFromContext($context));
    }

    /**
     * Provides valid data containing exception values and expected results.
     *
     * @return array
     */
    public function provideDataWithException() : array
    {
        return [
            [['exception' => new \RuntimeException('a message')], '\\RuntimeException', 'a message'],
            [['exception' => new \TypeError('an error')], '\\ErrorException', 'an error'],
        ];
    }

    /**
     * Provides valid data containing invalid exception or no exception values and expected results.
     *
     * @return array
     */
    public function provideDataWithoutException()
    {
        return [
            'null' => [['exception' => null]],
            'string' => [['exception' => 'a message']],
            'no exepting' => [[]],
        ];
    }
}
