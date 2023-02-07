<?php

declare(strict_types=1);

namespace TryAgainLater\PhpJit;

use Imagick;

class Mandelbrot
{
    private const mapping = [
       [ 66,  30,  15],
       [ 25,   7,  26],
       [  9,   1,  47],
       [  4,   4,  73],
       [  0,   7, 100],
       [ 12,  44, 138],
       [ 24,  82, 177],
       [ 57, 125, 209],
       [134, 181, 229],
       [211, 236, 248],
       [241, 233, 191],
       [248, 201,  95],
       [255, 170,   0],
       [204, 128,   0],
       [153,  87,   0],
       [106,  52,   3],
    ];

    private array $imagePixels = [];

    public function __construct(
        private int $width,
        private int $height,
    )
    {
    }

    private function mandelbrot(float $x, float $y)
    {
        $cr = $y - 0.5;
        $ci = $x;
        $zi = 0.0;
        $zr = 0.0;
        $i = 0;

        while (true) {
            $i++;

            $temp = $zr * $zi;

            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;

            $zr = $zr2 - $zi2 + $cr;
            $zi = $temp + $temp + $ci;

            if ($zi2 + $zr2 > 16) {
                return $i;
            }

            if ($i > 5000) {
                return 0;
            }
        }
    }

    public function generate(): void
    {
        for ($x = 0; $x < $this->width; ++$x) {
            for ($y = 0; $y < $this->height; ++$y) {
                $xMapped = ($x / $this->width - 0.5) * 2.5;
                $yMapped = ($y / $this->height - 0.5) * 2.5;

                $iterationsCount = $this->mandelbrot($xMapped, $yMapped);
                $color = self::mapping[$iterationsCount % count(self::mapping)];

                $this->imagePixels[] = $color[0];
                $this->imagePixels[] = $color[1];
                $this->imagePixels[] = $color[2];
            }
        }
    }

    public function writeToFile(string $filePath): void
    {
        $image = new Imagick();
        $image->newImage($this->width, $this->height, 'gray');
        $image->importImagePixels(
            0,
            0,
            $this->width,
            $this->height,
            'RGB',
            Imagick::PIXEL_CHAR,
            $this->imagePixels,
        );
        $image->setImageFormat('png');
        $image->writeImage($filePath);
    }
}
