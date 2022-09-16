<?php

namespace SubjectivePHPTest\Psr\Log;

use SubjectivePHP\Psr\Log\LevelValidatorTrait;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\LevelValidatorTrait
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
     *
     * @return void
     */
    public function validateLevelInvalid()
    {
        $this->expectException(\Psr\Log\InvalidArgumentException::class);
        $this->validateLevel('invalid');
    }
}
