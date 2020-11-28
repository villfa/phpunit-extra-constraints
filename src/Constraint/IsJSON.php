<?php

declare(strict_types=1);

namespace PHPUnitExtraConstraints\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

use function is_string;
use function json_decode;
use function json_last_error;
use function json_last_error_msg;

use const JSON_ERROR_NONE;

/**
 * Constraint that asserts that the value is a decodable JSON string.
 */
final class IsJSON extends Constraint
{
    /**
     * @inheritDoc
     */
    protected function matches($other): bool
    {
        return is_string($other) && $this->isValidJson($other);
    }

    /**
     * @psalm-suppress UnusedFunctionCall
     */
    private function isValidJson(string $value): bool
    {
        json_decode($value);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * @inheritDoc
     * @psalm-suppress UnusedFunctionCall
     */
    protected function additionalFailureDescription($other): string
    {
        if (!is_string($other)) {
            return '';
        }

        json_decode($other);

        return json_last_error_msg();
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'is a JSON string';
    }
}
