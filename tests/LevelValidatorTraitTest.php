<?php

namespace ChadicusTest\Psr\Log;

use Chadicus\Psr\Log\LevelValidatorTrait;

/**
 * @coversDefaultClass \Chadicus\Psr\Log\LevelValidatorTrait
 * @covers ::<private>
 */
final class LevelValidatorTraitTest extends \PHPUnit_Framework_TestCase
{
    use LevelValidatorTrait;

    /**
     * @test
     * @covers ::validateLevel
     *
     * @return void
     */
    public function validateLevelValid()
    {
        foreach ((new \ReflectionClass('\\Psr\\Log\\LogLevel'))->getConstants() as $constant) {
            $this->assertNull($this->validateLevel($constant));
        }
    }

    /**
     * @test
     * @covers ::validateLevel
     * @expectedException \Psr\Log\InvalidArgumentException
     *
     * @return void
     */
    public function validateLevelInvalid()
    {
        $this->validateLevel('invalid');
    }
}
