<?php

namespace SubjectivePHPTest\Psr\Log;

use SubjectivePHP\Psr\Log\LevelValidatorTrait;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\LevelValidatorTrait
 * @covers ::<private>
 */
final class LevelValidatorTraitTest extends \PHPUnit\Framework\TestCase
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
