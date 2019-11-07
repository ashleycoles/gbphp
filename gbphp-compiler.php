<?php

require_once 'vendor/autoload.php';

try {
    $config = new GBPHP\Compiler\Config();

    $outputter = new GBPHP\CommandLine\Outputter();

    $fileLoader = new GBPHP\FileSystem\FileLoader($config);

    $compiler = new GBPHP\Compiler\Compiler($config, $outputter);

    $app = new GBPHP\GBPHP($config, $fileLoader, $compiler);

    $app->compile();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
