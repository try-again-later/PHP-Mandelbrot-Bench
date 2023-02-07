<?php

declare(strict_types=1);

namespace TryAgainLater\PhpJit\Tests\Benchmark;

use PhpBench\Attributes\Revs;
use TryAgainLater\PhpJit\Mandelbrot;

class MandelbrotBench
{
    #[Revs(5)]
    public function benchRun()
    {
        $mandelbrot = new Mandelbrot(200, 200);
        $mandelbrot->generate();
    }
}
