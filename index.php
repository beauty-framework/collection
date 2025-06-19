<?php
declare(strict_types=1);

require "vendor/autoload.php";

$collection = lazy_collect(function () {
    for ($i = 0; $i < 5; $i++) {
        yield $i;
    }
});

echo json_encode($collection->toArray());