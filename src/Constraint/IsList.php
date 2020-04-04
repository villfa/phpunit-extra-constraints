<?php

declare(strict_types=1);

namespace PHPUnitExtraConstraints\Constraint;

use Generator;
use PHPUnit\Framework\Constraint\Constraint;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;

use function is_iterable;

/**
 * Constraint that asserts that the value is a sequential list
 */
final class IsList extends Constraint
{
    /** @var bool */
    private $acceptsGenerator;

    public function __construct(bool $acceptsGenerator = false)
    {
        $this->acceptsGenerator = $acceptsGenerator;
    }

    /**
     * @inheritDoc
     */
    protected function matches($other): bool
    {
        if (!is_iterable($other) || (!$this->acceptsGenerator && $other instanceof Generator)) {
            return false;
        }

        $expectedIndex = 0;
        /** @var mixed $_ */
        foreach ($other as $k => $_) {
            if ($k !== $expectedIndex) {
                return false;
            }
            $expectedIndex++;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function additionalFailureDescription($other): string
    {
        if (!is_iterable($other) || (!$this->acceptsGenerator && $other instanceof Generator)) {
            return '';
        }

        $expectedIndex = 0;
        /** @var mixed $_ */
        foreach ($other as $k => $_) {
            if ($k !== $expectedIndex) {
                return (new Differ(new UnifiedDiffOutputBuilder("--- Expected\n+++ Actual\n")))
                    ->diff("index: $expectedIndex", "index: $k");
            }
            $expectedIndex++;
        }

        // Cannot happen
        // @codeCoverageIgnoreStart
        return '';
        // @codeCoverageIgnoreEnd
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'is a list';
    }
}
