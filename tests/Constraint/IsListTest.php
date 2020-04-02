<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints\Constraint;

use Generator;
use PHPUnitExtraConstraints\Constraint\IsList;
use Tests\PHPUnitExtraConstraints\CustomTestCase;

class IsListTest extends CustomTestCase
{
    /**
     * @dataProvider provideValidLists
     * @testdox testIsListWithValidLists: $value
     *
     * @param iterable<mixed> $value
     */
    public function testIsListWithValidLists(iterable $value): void
    {
        $constraint = new IsList();
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<iterable<mixed>>>
     */
    public function provideValidLists(): iterable
    {
        yield [['a', 'b']];
        yield [[0, 1]];
        yield [[]];
        yield [[null]];
        yield [[0 => 'foo', 1 => 'bar']];
        yield [['0' => 'foo', '1' => 'bar']];
    }

    /**
     * @dataProvider provideInvalidLists
     * @testdox testIsListWithInvalidLists: $value
     *
     * @param mixed $value
     */
    public function testIsListWithInvalidLists($value): void
    {
        $constraint = new IsList();
        $this->expectAssertionFailedError('is a list');
        self::assertThat($value, $constraint);
    }

    /**
     * @return iterable<array<mixed>>
     */
    public function provideInvalidLists(): iterable
    {
        yield [['a' => 0, 'b' => 1]];
        yield [[1 => 0]];
        yield [[-1 => 0]];
        yield [['a', 2 => 'b']];
        yield [null];
        yield [true];
        yield [false];
        yield [0];
        yield [1];
        yield [''];
        yield ['abc'];
        yield [(object) []];
        yield [(static function (): Generator {
            while (true) {
                yield 1;
            }
        })()];
    }

    public function testIsListWithValidGenerator(): void
    {
        $value = (static function (): Generator {
            yield 'a';
            yield 'b';
        })();
        $constraint = new IsList(true);
        self::assertThat($value, $constraint);
    }

    public function testIsListWithInvalidGenerator(): void
    {
        $value = (static function (): Generator {
            yield 'a' => 0;
            yield 'b' => 1;
        })();
        $constraint = new IsList(true);
        $this->expectAssertionFailedError('is a list');
        self::assertThat($value, $constraint);
    }

    public function testAdditionalDescriptionWithNonSequentialList(): void
    {
        $constraint = new IsList();
        $this->expectAssertionFailedError([
            'is a list',
            "--- Expected\n+++ Actual\n",
            "-index: 0\n+index: a\n",
        ]);
        self::assertThat(['a' => 0], $constraint);
    }
}
