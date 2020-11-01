<?php

declare(strict_types=1);

namespace PHPUnitExtraConstraints\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

use function is_string;
use function strpos;

/**
 * Constraint that asserts that a string starts with another string.
 */
final class StringStartsWith extends Constraint
{
    /** @var string */
    private $needle;

    public function __construct(string $needle)
    {
        $this->needle = $needle;
    }

    /**
     * @inheritDoc
     */
    protected function matches($other): bool
    {
        return is_string($other)
            && ($this->needle === '' || strpos($other, $this->needle) === 0);
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'starts with ' . $this->needle;
    }
}
