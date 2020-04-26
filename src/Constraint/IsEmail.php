<?php

declare(strict_types=1);

namespace PHPUnitExtraConstraints\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

use function filter_var;
use function is_string;

use const FILTER_VALIDATE_EMAIL;

/**
 * Constraint that asserts that a string contains only an email address
 */
final class IsEmail extends Constraint
{
    /**
     * @inheritDoc
     */
    protected function matches($other): bool
    {
        return is_string($other)
            && filter_var($other, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'is an email address';
    }
}
