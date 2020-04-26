<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use PHPUnitExtraConstraints\Constraint\IsEmail;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

class IsEmailTest extends CustomTestCase
{
    /**
     * @dataProvider provideValidEmails
     * @testdox testWithValidEmail: $value
     *
     * @param string $value
     */
    public function testWithValidEmail(string $value): void
    {
        $constraint = new IsEmail();
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideValidEmails(): iterable
    {
        yield ['john.doe@g.com'];
    }

    /**
     * @dataProvider provideInvalidEmails
     * @testdox testWithInvalidEmail: $value
     *
     * @param mixed $value
     */
    public function testWithInvalidEmail($value): void
    {
        $constraint = new IsEmail();
        $this->expectAssertionFailedError('is an email address');
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<mixed>>
     */
    public function provideInvalidEmails(): iterable
    {
        yield [null];
        yield [''];
        yield [true];
        yield [false];
        yield [0];
        yield [1];
        yield [[]];
        yield [(object) []];
        yield ['not an email'];
        yield ['@@@'];
    }
}
