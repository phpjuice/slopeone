# Slopeone

![PHP Composer](https://github.com/phpjuice/slopeone/workflows/PHP%20Composer/badge.svg)
[![Build Status](https://travis-ci.com/phpjuice/slopeone.svg?branch=master)](https://travis-ci.com/phpjuice/slopeone)
[![Total Downloads](https://poser.pugx.org/phpjuice/slopeone/downloads)](https://packagist.org/packages/phpjuice/slopeone)

PHP implementation of the Weighted Slope One rating-based collaborative filtering scheme.



## Requirements

Slopeone Package requires PHP 5.6+

> **WARNING:** This library may not function correctly on PHP < 5.6.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

The supported way of installing the Slopeone Package is via Composer.

```sh
$ composer require phpjuice/slopeone
```

## Usage

Slopeone Package is designed to be very simple and straightforward to use. All you have to do is to load rating data, then predict future ratings based on the training set provided

### Loading files

The `Slopeone` object is created by direct instantiation:

```php
use PHPJuice\Slopeone\Algorithm;

// Create an instance
$slopeone = new Algorithm();

```

### Adding Rating values

Adding Rating values can be easly done by providing an array of users ratings via the update() method:

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

you can easly run tests using composer

```bash
$ composer test
```

## Built With

- [PHP](http://www.php.net) - The programing language used
- [Composer](https://getcomposer.org) - Dependency Management

## Contributing

Please read [CONTRIBUTING](CONTRIBUTING.md) for details.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/PHPJuice/slopeone/tags).

## Authors

- [ElHaouari Mohammed](https://github.com/elhaouari-mohammed)

See also the list of [contributors](https://gitlab.com/opencf/opencf/graphs/master) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](./LICENSE) file for details


![PHP Composer](https://github.com/phpjuice/slopeone/workflows/PHP%20Composer/badge.svg)
[![Build Status](https://travis-ci.com/phpjuice/slopeone.svg?branch=master)](https://travis-ci.com/phpjuice/slopeone)
[![Total Downloads](https://poser.pugx.org/phpjuice/slopeone/downloads)](https://packagist.org/packages/phpjuice/slopeone)
