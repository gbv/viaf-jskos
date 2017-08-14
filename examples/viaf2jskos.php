<?php

/**
 * Query VIAF via command line.
 */

if (php_sapi_name() != "cli") exit;
if (count($argv) < 2) {
    print "usage: php {$argv[0]} URI|ID|search\n";
    exit;
}

$arg = $argv[1];
if (substr($arg, 0, 21) == 'http://viaf.org/viaf/') {
    $query = ['uri' => $arg];
} elseif (preg_match('/^\d+$/', $arg)) {
    $query = ['uri' => "http://viaf.org/viaf/$arg"];
} else {
    array_shift($argv);
    $query = ['search' => implode(' ', $argv)];
}

require __DIR__ . '/../vendor/autoload.php';

$service = new \VIAF\JSKOS\Service();
$jskos = $service->query($query);
if ($jskos) {
    print "$jskos\n";
}
