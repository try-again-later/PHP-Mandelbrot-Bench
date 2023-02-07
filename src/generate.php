<?php

declare(strict_types=1);

use TryAgainLater\PhpJit\Mandelbrot;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$mandelbrot = new Mandelbrot(600, 600);
$mandelbrot->generate();
$mandelbrot->writeToFile('./out/out.png');
