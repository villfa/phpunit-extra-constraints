<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use PHPUnitExtraConstraints\Constraint\StringStartsWith;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

class StringStartsWithTest extends CustomTestCase
{
    /**
     * @dataProvider provideValidStrings
     * @testdox testWithValidString: $value starts with $needle
     *
     * @param string $needle
     * @param string $value
     */
    public function testWithValidString(string $needle, string $value): void
    {
        $constraint = new StringStartsWith($needle);
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideValidStrings(): iterable
    {
        yield ['a', 'abc'];
        yield ['ab', 'abc'];
        yield ['abc', 'abc'];
        yield ['', 'abc'];
        yield ['0', '00'];
    }

    /**
     * @dataProvider provideInvalidStrings
     * @testdox testWithInvalidString: $value doesn't start with $needle
     *
     * @param string $needle
     * @param mixed $value
     */
    public function testWithInvalidString(string $needle, $value): void
    {
        $constraint = new StringStartsWith($needle);
        $this->expectAssertionFailedError('starts with ' . $needle);
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<mixed>>
     */
    public function provideInvalidStrings(): iterable
    {
        yield ['zzz', null];
        yield ['zzz', true];
        yield ['zzz', false];
        yield ['zzz', 0];
        yield ['zzz', 1];
        yield ['zzz', []];
        yield ['zzz', (object) []];
        yield ['zzz', 'abc'];
        yield ['zzz', 'z'];
    }
}
