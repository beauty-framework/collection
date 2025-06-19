<?php
declare(strict_types=1);

namespace Beauty\Collection;

use PHPUnit\Framework\TestCase;

class LazyCollectionTest extends TestCase
{
    public function testMap(): void
    {
        $col = new LazyCollection(fn() => yield from [1, 2, 3]);
        $result = $col->map(fn($v) => $v * 10)->toArray();

        $this->assertSame([10, 20, 30], $result);
    }

    public function testChunk(): void
    {
        $col = new LazyCollection(fn() => yield from [1, 2, 3, 4, 5]);
        $chunks = $col->chunk(2)->toArray();

        $this->assertCount(3, $chunks);
        $this->assertSame([1, 2], $chunks[0]);
    }

    public function testReduce(): void
    {
        $col = new LazyCollection(fn() => yield from [1, 2, 3]);
        $sum = $col->reduce(fn($acc, $v) => $acc + $v, 0);

        $this->assertSame(6, $sum);
    }

    public function testFlatMap(): void
    {
        $col = new LazyCollection(fn() => yield from [1, 2]);
        $flattened = $col->flatMap(fn($v) => [$v, $v * 10])->toArray();

        $this->assertSame([1, 10, 2, 20], $flattened);
    }

    public function testFirst(): void
    {
        $col = new LazyCollection(fn() => yield from [42, 100]);
        $this->assertSame(42, $col->first());
    }
}
