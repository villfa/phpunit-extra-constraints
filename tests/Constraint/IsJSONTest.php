<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use PHPUnitExtraConstraints\Constraint\IsJSON;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

class IsJSONTest extends CustomTestCase
{
    /**
     * @dataProvider provideValidJSONStrings
     * @testdox testWithValidJSONStrings: $value
     *
     * @param string $value
     */
    public function testWithValidJSONStrings(string $value): void
    {
        $constraint = new IsJSON();
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideValidJSONStrings(): iterable
    {
        yield ['[1,2,3]'];
        yield ['{"foo":"bar"}'];
        yield ['"foo"'];
        yield ['0'];
        yield ['null'];
        yield ['false'];
    }

    /**
     * @dataProvider provideInvalidArgument
     * @testdox testWithInvalidArgument: $value
     *
     * @param mixed $value
     */
    public function testWithInvalidArgument($value): void
    {
        $constraint = new IsJSON();
        $this->expectAssertionFailedError('is a JSON string');
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<mixed>>
     */
    public function provideInvalidArgument(): iterable
    {
        yield [null];
        yield [true];
        yield [false];
        yield [0];
        yield [1];
        yield [[]];
        yield [(object) []];
    }

    /**
     * @dataProvider provideInvalidJSONStrings
     * @testdox testWithInvalidJSONStrings: $value
     *
     * @param string $value
     */
    public function testWithInvalidJSONStrings(string $value): void
    {
        $constraint = new IsJSON();
        $this->expectAssertionFailedError([
            'is a JSON string',
            'Syntax error',
        ]);
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideInvalidJSONStrings(): iterable
    {
        yield [''];
        yield ['not a valid JSON string'];
        yield ['[[['];
    }
}
