#!/usr/bin/env php
<?php

/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 09:55
 *
 * Wrapper for an example implementation.
 */


require dirname(__DIR__) . '/vendor/autoload.php';

use JontyBale\HttpParser\Command\FetchProductsCommand;
use JontyBale\HttpParser\Command\FetchUriMetaCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new FetchProductsCommand());
$application->add(new FetchUriMetaCommand());
$application->run();
