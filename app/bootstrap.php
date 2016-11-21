<?php

use Felipecwb\Catho\Application;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application([
    'debug' => true,
    // directory
    'directory.base' => dirname(__DIR__)
]);

$app->run();
