# PHPUnit Extra Constraints

## Installation

```sh
composer require --dev villfa/phpunit-extra-constraints
```

## Usage

Here a basic example:

```php
<?php
require_once 'vendor/autoload.php';

use PHPUnitExtraConstraints\Constraint\IsDate;

class ExampleTest extends PHPUnit\Framework\TestCase
{
    public function testDate(): void
    {
        $this->assertThat('2020-04-02', new IsDate('Y-m-d'));
    }
}
```

## Available extra constraints

* [IsDate](./src/Constraint/IsDate.php): asserts that a string is a valid date according a given format
* [IsList](./src/Constraint/IsList.php): asserts that the value is a sequential list

## Tests

To validate and test the library:

```sh
composer run-script test
```

## License

[MIT](./LICENSE)

## Other libraries proposing extra constraints

* https://github.com/etsy/phpunit-extensions
* https://github.com/ergebnis/phpunit-framework-constraint
* https://github.com/Datamedrix/phpunit-ext
* https://github.com/spawnia/phpunit-assert-directory
* https://github.com/MarcinOrlowski/phpunit-extra-asserts
* https://github.com/kuria/phpunit-extras
* https://github.com/GeckoPackages/GeckoPHPUnit (Abandoned)
