<?php

declare(strict_types=1);

namespace Tests\PHPUnitExtraConstraints;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;

use function array_map;
use function count;
use function implode;
use function is_array;
use function is_string;
use function preg_quote;

abstract class CustomTestCase extends TestCase
{
    /**
     * @param string[]|string|null $message
     */
    public function expectAssertionFailedError($message = null): void
    {
        $this->expectException(AssertionFailedError::class);

        if (is_array($message)) {
            if (count($message) > 0) {
                $message = implode('.*', array_map('preg_quote', $message));
            } else {
                $message = null;
            }
        } elseif (is_string($message)) {
            $message = preg_quote($message);
        } else {
            return;
        }

        if ($message !== null) {
            $this->expectExceptionMessageMatches('/.*' . $message . '.*/s');
        }
    }
}
