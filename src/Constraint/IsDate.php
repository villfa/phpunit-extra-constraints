<?php

declare(strict_types=1);

namespace PHPUnitExtraConstraints\Constraint;

use DateTime;
use Exception;
use PHPUnit\Framework\Constraint\Constraint;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;

use function is_string;

/**
 * Constraint that asserts that a string is a valid date according a given format.
 */
final class IsDate extends Constraint
{
    /** @var string */
    private $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * @inheritDoc
     */
    protected function matches($other): bool
    {
        if (!is_string($other)) {
            return false;
        }

        $date = DateTime::createFromFormat($this->format, $other);

        return $date !== false && $other === $date->format($this->format);
    }

    /**
     * @inheritDoc
     */
    protected function additionalFailureDescription($other): string
    {
        if (!is_string($other)) {
            return '';
        }

        try {
            $date = new DateTime($other);
            return (new Differ(new UnifiedDiffOutputBuilder("--- Expected\n+++ Actual\n")))
                ->diff($date->format($this->format), $other);
        } catch (Exception $e) {
            return 'The string is not parsable as a date';
        }
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'is a string respecting the ' . $this->format . ' datetime format';
    }
}
