# PHPUnit Extra Constraints

[![Travis Build Status](https://secure.travis-ci.org/villfa/phpunit-extra-constraints.png?branch=master)](http://travis-ci.org/villfa/phpunit-extra-constraints)
[![AppVeyor Build Status](https://ci.appveyor.com/api/projects/status/github/villfa/phpunit-extra-constraints?branch=master&svg=true)](https://ci.appveyor.com/project/villfa/phpunit-extra-constraints)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=villfa_phpunit-extra-constraints&metric=alert_status)](https://sonarcloud.io/dashboard?id=villfa_phpunit-extra-constraints)
[![Latest Stable Version](https://poser.pugx.org/villfa/phpunit-extra-constraints/v/stable)](https://packagist.org/packages/villfa/phpunit-extra-constraints)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)
[![License](https://poser.pugx.org/villfa/phpunit-extra-constraints/license)](./LICENSE)
[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)

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
* [IsURL](./src/Constraint/IsURL.php): asserts that a string contains only an URL
* [IsEmail](./src/Constraint/IsEmail.php): asserts that a string contains only an email address

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
