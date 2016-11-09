# Parallel

[![Build Status](https://travis-ci.org/functional-php/parallel.svg)](https://travis-ci.org/functional-php/parallel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/functional-php/parallel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/functional-php/parallel/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/functional-php/parallel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/functional-php/parallel/?branch=master)
[![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/functional-php/parallel.svg)](http://isitmaintained.com/project/functional-php/parallel "Average time to resolve an issue")
[![Percentage of issues still open](http://isitmaintained.com/badge/open/functional-php/parallel.svg)](http://isitmaintained.com/project/functional-php/parallel "Percentage of issues still open")
[![Chat on Gitter](https://img.shields.io/gitter/room/gitterHQ/gitter.svg)](https://gitter.im/functional-php)

Parallel implementation of the higher-order functions `map`, `filter` and `fold` using the 
[phtreads library](https://github.com/krakjoe/pthreads). This way the computation is distributed
across multiple threads so that the whole computational power of the computer can be used.

See the pthreads library requirement. If you are not sure they will be satisfied, install the [polyfill](https://github.com/krakjoe/pthreads-polyfill).

## Installation

    composer require functional-php/parallel

## Basic Usage

```php

use FunctionalPHP\Parallel as p;

p\map(4, function($i) { return $i + 2; }, [1, 2, 3, 4]);
// will return [3, 4, 5, 6]

p\filter(4, function($i) { return $i % 2 == 0; }, [1, 2, 3, 4]);
// will return [2, 4]

p\fold(4, function($a, $b) { return $a + $b; }, [1, 2, 3, 4], 0);
// will return 10

```

## Testing

You can run the test suite for the library using:

    composer test
    
A test report will be available in the `reports` directory.

## Contributing

Any contribution welcome :

- Ideas
- Pull requests
- Issues
