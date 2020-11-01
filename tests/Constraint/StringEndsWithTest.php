<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use PHPUnitExtraConstraints\Constraint\StringEndsWith;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

class StringEndsWithTest extends CustomTestCase
{
    /**
     * @dataProvider provideValidStrings
     * @testdox testWithValidString: $value ends with $needle
     *
     * @param string $needle
     * @param string $value
     */
    public function testWithValidString(string $needle, string $value): void
    {
        $constraint = new StringEndsWith($needle);
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideValidStrings(): iterable
    {
        yield ['c', 'abc'];
        yield ['bc', 'abc'];
        yield ['abc', 'abc'];
        yield ['', 'abc'];
        yield ['0', '00'];
    }

    /**
     * @dataProvider provideInvalidStrings
     * @testdox testWithInvalidString: $value doesn't end with $needle
     *
     * @param string $needle
     * @param mixed $value
     */
    public function testWithInvalidString(string $needle, $value): void
    {
        $constraint = new StringEndsWith($needle);
        $this->expectAssertionFailedError('ends with ' . $needle);
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
