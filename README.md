# PHPostcode

[![Build Status](https://travis-ci.org/dank00/PHPostcode.svg?branch=master)](https://travis-ci.org/dank00/PHPostcode)
[![Coverage Status](https://coveralls.io/repos/github/dank00/PHPostcode/badge.svg?branch=master)](https://coveralls.io/github/dank00/PHPostcode?branch=coveralls)

A Postcode value object based on this https://www.mrs.org.uk/pdf/postcodeformat.pdf

## Installation and Usage

The package is available on packagist.org, so use composer:

```bash
composer require dank00/phpostcode
```

Most applications will store postcodes as strings so you will typically use the `fromString` method:

```php
$string = $address->getPostcode(); // 'CW8 4BW'

$postcode = Postcode::fromString($string);

echo $postcode->toString(); // 'CW8 4BW'
echo $postcode->getOutwardCode()->toString(); // 'CW8'
echo $postcode->getInwardCode()->getUnit(); // `BW`
```

If you need more precision, then `OutwardCode` and `InwardCode` also have `fromString` methods, or use the constructors directly.

An `InvalidCodeException` is thrown from the constructors of `OutwardCode` and `InwardCode` in the case that the inputs do not match the fixed patterns (which are also defined in those classes).
