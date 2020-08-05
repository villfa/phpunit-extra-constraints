<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use PHPUnitExtraConstraints\Constraint\IsDate;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

use function sprintf;

class IsDateTest extends CustomTestCase
{
    private const DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @dataProvider provideValidDates
     * @testdox testWithValidDates: $value
     *
     * @param string $value
     */
    public function testWithValidDates(string $value): void
    {
        $constraint = new IsDate(self::DATETIME_FORMAT);
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideValidDates(): iterable
    {
        yield ['2020-03-31 11:52:00'];
        yield ['1969-03-31 11:52:00'];
    }

    /**
     * @dataProvider provideInvalidDates
     * @testdox testWithInvalidDates: $value
     *
     * @param mixed $value
     */
    public function testWithInvalidDates($value): void
    {
        $constraint = new IsDate(self::DATETIME_FORMAT);
        $this->expectAssertionFailedError(
            sprintf('is a string respecting the %s datetime format', self::DATETIME_FORMAT)
        );
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<mixed>>
     */
    public function provideInvalidDates(): iterable
    {
        yield [null];
        yield [''];
        yield [true];
        yield [false];
        yield [0];
        yield [1];
        yield [[]];
        yield [(object) []];
        // invalid format
        yield ['2020-01-20'];
        // wrong day
        yield ['2020-01-35 16:43:00'];
    }

    public function testAdditionalDescriptionWithValidDate(): void
    {
        $constraint = new IsDate(self::DATETIME_FORMAT);
        $this->expectAssertionFailedError([
            sprintf('is a string respecting the %s datetime format', self::DATETIME_FORMAT),
            "--- Expected\n+++ Actual\n",
            "-2020-01-20 00:00:00\n+2020-01-20\n",
        ]);
        self::assertThat('2020-01-20', $constraint);
    }

    public function testAdditionalDescriptionWithInvalidDate(): void
    {
        $constraint = new IsDate(self::DATETIME_FORMAT);
        $this->expectAssertionFailedError([
            sprintf('is a string respecting the %s datetime format', self::DATETIME_FORMAT),
            'The string is not parsable as a date',
        ]);
        self::assertThat('Not a date', $constraint);
    }
}
