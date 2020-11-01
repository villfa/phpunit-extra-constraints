<?php

declare(strict_types=1);

namespace PHPUnitExtraConstraints\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

use function is_string;
use function strlen;
use function substr_compare;

/**
 * Constraint that asserts that a string ends with another string.
 */
final class StringEndsWith extends Constraint
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
            && self::endsWith($other, $this->needle);
    }

    private static function endsWith(string $haystack, string $needle): bool
    {
        return '' === $needle || ('' !== $haystack && 0 === substr_compare($haystack, $needle, -strlen($needle)));
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'ends with ' . $this->needle;
    }
}
