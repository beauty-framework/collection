<?php
declare(strict_types=1);

if (!function_exists('collect')) {
    function collect(iterable $items): \Beauty\Collection\Contracts\CollectionInterface {
        return new \Beauty\Collection\Collection($items);
    }
}

if (!function_exists('paginated_collect')) {
    function paginated_collect(iterable $items): \Beauty\Collection\Contracts\PaginatedCollectionInterface {
        return new \Beauty\Collection\PaginatedCollection($items);
    }
}

if (!function_exists('lazy_collect')) {
    function lazy_collect(callable $callback): \Beauty\Collection\Contracts\LazyCollectionInterface {
        return new \Beauty\Collection\LazyCollection($callback);
    }
}