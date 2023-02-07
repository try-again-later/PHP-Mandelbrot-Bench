# PHP Mandelbrot Benchmark

Run the benchmark:

```sh
composer install
./vendor/bin/phpbench run tests/Benchmark --report=default
```

Generate an image (will be available at `./out/out.png`):

```sh
php ./src/generate.php
```
