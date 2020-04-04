<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use PHPUnitExtraConstraints\Constraint\IsURL;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

class IsURLTest extends CustomTestCase
{
    /**
     * @dataProvider provideValidURLs
     * @testdox testWithValidURL: $value
     *
     * @param string $value
     */
    public function testWithValidURL(string $value): void
    {
        $constraint = new IsURL();
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideValidURLs(): iterable
    {
        yield ['http://www.example.com'];
    }

    /**
     * @dataProvider provideInvalidURLs
     * @testdox testWithInvalidURL: $value
     *
     * @param mixed $value
     */
    public function testWithInvalidURL($value): void
    {
        $constraint = new IsURL();
        $this->expectAssertionFailedError('is an URL');
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<mixed>>
     */
    public function provideInvalidURLs(): iterable
    {
        yield [null];
        yield [''];
        yield [true];
        yield [false];
        yield [0];
        yield [1];
        yield [[]];
        yield [(object) []];
        yield ['not an url'];
    }
}
