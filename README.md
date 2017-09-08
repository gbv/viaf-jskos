# viaf-jskos

[![Latest Version](https://img.shields.io/packagist/v/gbv/viaf-jskos.svg?style=flat-square)](https://packagist.org/packages/gbv/viaf-jskos)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/gbv/viaf-jskos.svg?style=flat-square)](https://travis-ci.org/gbv/viaf-jskos)
[![Coverage Status](https://img.shields.io/coveralls/gbv/viaf-jskos/master.svg?style=flat-square)](https://coveralls.io/r/gbv/viaf-jskos)
[![Quality Score](https://img.shields.io/scrutinizer/g/gbv/viaf-jskos.svg?style=flat-square)](https://scrutinizer-ci.com/g/gbv/viaf-jskos)
[![Total Downloads](https://img.shields.io/packagist/dt/gbv/viaf-jskos.svg?style=flat-square)](https://packagist.org/packages/gbv/jskos)

This repository contains a wrapper to access the [Virtual International Authority File (VIAF)](http://viaf.org) in [JSKOS format](https://gbv.github.io/jskos/) via [Entity Lookup Microservice API (ELMA)](http://gbv.github.io/elma/).

# Requirements

Requires PHP 7, [jskos-rdf](https://packagist.org/packages/gbv/jskos-rdf) package and a
[HTTP client-implementation](https://packagist.org/packages/php-http/client-implementation) package. 

# Installation

Install a HTTP client implementation package, e.g. [curl-client](https://packagist.org/packages/php-http/curl-client) and this package:

~~~bash
composer require php-http/curl-client gbv/viaf-jskos
~~~

This will automatically create `composer.json` for your project (unless it already exists) and add viaf-jskos as dependency. Composer also generates `vendor/autoload.php` to get autoloading of all dependencies.

# Usage

The wrapper can be used as instance of class `\JSKOS\Service\VIAF`, a subclass of `\JSKOS\Service`:

~~~php
require 'vendor/autoload.php';

$service = new \JSKOS\Service\VIAF();

$jskos = $service->queryURI("http://viaf.org/viaf/102333412");
$jskos = $service->query(["uri" => "http://viaf.org/viaf/102333412"]);
$jskos = $service->query(["notation" => "102333412"]);
~~~

This repository contains a command line script to query VIAF in JSKOS format:

    php examples/viaf2jskos.php http://viaf.org/viaf/102333412
    php examples/viaf2jskos.php 102333412
    php examples/viaf2jskos.php Jane Austen

# Contributung

Bugs and feature request are [tracked on GitHub](https://github.com/gbv/viaf-jskos/issues).

See `CONTRIBUTING.md` of repository [jskos-php](https://packagist.org/packages/gbv/jskos) for general guidelines.

# Author and License

Jakob Voß <jakob.voss@gbv.de>

This package is licensed under the LGPL license (see `LICENSE` for details).
