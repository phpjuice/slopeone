# Slopeone

![Tests](https://github.com/phpjuice/slopeone/workflows/Tests/badge.svg?branch=main)
[![Latest Stable Version](http://poser.pugx.org/phpjuice/slopeone/v)](https://packagist.org/packages/phpjuice/slopeone)
[![Total Downloads](http://poser.pugx.org/phpjuice/slopeone/downloads)](https://packagist.org/packages/phpjuice/slopeone)
[![License](http://poser.pugx.org/phpjuice/slopeone/license)](https://packagist.org/packages/phpjuice/slopeone)

PHP implementation of the Weighted Slope One rating-based collaborative filtering scheme.

## Installation

Slopeone Package requires PHP 7.4 or higher.

> **INFO:** If you are using an older version of php this package may not function correctly.

The supported way of installing `Slopeone` package is via Composer.

```bash
composer require phpjuice/slopeone
```

## Usage

Slopeone Package is designed to be very simple and straightforward to use. All you have to do is to load rating data,
then predict future ratings based on the training set provided.

### Loading files

The `Slopeone` object is created by direct instantiation:

```php
use PHPJuice\Slopeone\Algorithm;

// Create an instance
$slopeone = new Algorithm();
```

### Adding Rating values

Adding Rating values can be easily done by providing an array of users ratings via the update() method:

```php

$data =[
  [
    "squid" => 1,
    "cuttlefish" => 0.5,
    "octopus" => 0.2
  ],
  [
    "squid" => 1,
    "octopus" => 0.5,
    "nautilus" => 0.2
  ],
  [
    "squid" => 0.2,
    "octopus" => 1,
    "cuttlefish" => 0.4,
    "nautilus" => 0.4
  ],
  [
    "cuttlefish" => 0.9,
    "octopus" => 0.4,
    "nautilus" => 0.5
  ]
];

$slopeone->update($data);
```

### Predicting ratings

all you have to do to predict ratings for a new user is to run the slopeone::predict method

```php
$results = $slopeone->predict([
    "squid" => 0.4
]);
```

this should produce the following results

```php
[
  "cuttlefish"=>0.25,
  "octopus"=>0.23333333333333,
  "nautilus"=>0.1
];
```

## Running the tests

you can easily run tests using composer

```bash
$ composer test
```

## Built With

- [PHP](http://www.php.net) - The programing language used
- [Composer](https://getcomposer.org) - Dependency Management
- [Pest](https://pestphp.com) - An elegant PHP Testing Framework

## Changelog

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING.md](./CONTRIBUTING.md) for details and a todo list.

## Security

If you discover any security related issues, please email author instead of using the issue tracker.

## Credits

- [Daniel Lemire](https://github.com/lemire)
- [SlopeOne Predictors for Online Rating-Based Collaborative Filtering](https://www.researchgate.net/publication/1960789_Slope_One_Predictors_for_Online_Rating-Based_Collaborative_Filtering)

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see
the [tags on this repository](https://github.com/PHPJuice/slopeone/tags).

## License

license. Please see the [Licence](https://github.com/phpjuice/slopeone/blob/main/LICENSE) for more information.

![Tests](https://github.com/phpjuice/slopeone/workflows/Tests/badge.svg?branch=main)
[![Latest Stable Version](http://poser.pugx.org/phpjuice/slopeone/v)](https://packagist.org/packages/phpjuice/slopeone)
[![Total Downloads](http://poser.pugx.org/phpjuice/slopeone/downloads)](https://packagist.org/packages/phpjuice/slopeone)
[![License](http://poser.pugx.org/phpjuice/slopeone/license)](https://packagist.org/packages/phpjuice/slopeone)
