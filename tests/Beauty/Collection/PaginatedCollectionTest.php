<?php
declare(strict_types=1);

namespace Beauty\Collection;

use PHPUnit\Framework\TestCase;

class PaginatedCollectionTest extends TestCase
{
    public function testPaginate(): void
    {
        $col = new PaginatedCollection(range(1, 10));
        $page = $col->paginate(3, 2)->toArray();

        $this->assertSame([3 => 4, 4 => 5, 5 => 6], $page);
    }
}
