<?php
declare(strict_types=1);

namespace Beauty\Collection;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testMap(): void
    {
        $col = new Collection([1, 2, 3]);
        $result = $col->map(fn($x) => $x * 2)->toArray();

        $this->assertSame([2, 4, 6], $result);
    }

    public function testFilter(): void
    {
        $col = new Collection([1, 2, 3, 4]);
        $result = $col->filter(fn($x) => $x % 2 === 0)->toArray();

        $this->assertSame([1 => 2, 3 => 4], $result);
    }

    public function testWhere(): void
    {
        $col = new Collection([
            ['name' => 'a'], ['name' => 'b'], ['name' => 'a']
        ]);

        $result = $col->where('name', 'a')->toArray();

        $this->assertCount(2, $result);
        $this->assertSame('a', $result[0]['name']);
    }

    public function testSortBy(): void
    {
        $col = new Collection([
            ['name' => 'c'], ['name' => 'a'], ['name' => 'b']
        ]);

        $sorted = $col->sortBy('name')->values()->toArray();
        $this->assertSame('a', $sorted[0]['name']);
        $this->assertSame('b', $sorted[1]['name']);
        $this->assertSame('c', $sorted[2]['name']);
    }

    public function testFirstAndLast(): void
    {
        $col = new Collection(['first', 'middle', 'last']);

        $this->assertSame('first', $col->first());
        $this->assertSame('last', $col->last());
    }
}
