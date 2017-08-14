This repository contains a wrapper to access the [Virtual International Authority File (VIAF)](http://viaf.org) in [JSKOS format](https://gbv.github.io/jskos/) via [Entity Lookup Microservice API (ELMA)](http://gbv.github.io/elma/).

# Requirements

Requires PHP 7 and the [jskos-rdf](https://packagist.org/packages/gbv/jskos-rdf) PHP library.

# Installation

~~~bash
composer require gbv/viaf-jskos
~~~

This will automatically create `composer.json` for your project (unless it already exists) and add viaf-jskos as dependency. Composer also generates `vendor/autoload.php` to get autoloading of all dependencies.

# Usage

The wrapper can be used as instance of class `\VIAF\JSKOS\Service`, a subclass of `\JSKOS\Service`:

~~~php
require 'vendor/autoload.php';

$service = new \VIAF\JSKOS\Service();

$jskos = $service->queryURI("http://viaf.org/viaf/102333412/");
$jskos = $service->query(["uri" => "http://viaf.org/viaf/102333412/"]);
$jskos = $service->query(["notation" => "102333412"]);
~~~

See [jskos-php-examples](https://github.com/gbv/jskos-php-examples/) for an example how to use the wrapper as part of a larger PHP application.

This repository also contains a command line script to query VIAF in JSKOS format:

    php examples/viaf2jskos.php http://viaf.org/viaf/102333412/
    php examples/viaf2jskos.php 102333412
    php examples/viaf2jskos.php Jane Austen

# Contributung

Bugs and feature request are [tracked on GitHub](https://github.com/gbv/viaf-jskos/issues).

See `CONTRIBUTING.md` of repository [jskos-php](https://packagist.org/packages/gbv/jskos) for general guidelines.

# Author and License

Jakob Voß <jakob.voss@gbv.de>

viaf-jskos is licensed under the LGPL license (see `LICENSE` for details).

[![Latest Stable Version](https://poser.pugx.org/gbv/viaf-jskos/v/stable)](https://packagist.org/packages/gbv/viaf-jskos)
[![License](https://poser.pugx.org/gbv/jskos/license)](https://packagist.org/packages/gbv/viaf-jskos)
[![Build Status](https://img.shields.io/travis/gbv/viaf-jskos.svg)](https://travis-ci.org/gbv/viaf-jskos)
[![Coverage Status](https://coveralls.io/repos/gbv/viaf-jskos/badge.svg?branch=master)](https://coveralls.io/r/gbv/viaf-jskos)
