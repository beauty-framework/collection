<?php
declare(strict_types=1);

namespace Beauty\Collection;

use Beauty\Collection\Contracts\PaginatedCollectionInterface;
use Beauty\Collection\Operations\HasPaginationTrait;

class PaginatedCollection extends Collection implements PaginatedCollectionInterface
{
    use HasPaginationTrait;
}