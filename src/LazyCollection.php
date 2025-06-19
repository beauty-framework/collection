<?php
declare(strict_types=1);

namespace Beauty\Collection;

use Beauty\Collection\Contracts\ArrayableInterface;
use Beauty\Collection\Contracts\LazyCollectionInterface;
use Beauty\Collection\Operations\ImplementsLazyTrait;
use Closure;
use Traversable;

class LazyCollection implements LazyCollectionInterface, ArrayableInterface
{
    use ImplementsLazyTrait;

    /**
     * @var Closure
     */
    protected Closure $generator;

    /**
     * @param callable $generator
     */
    public function __construct(callable $generator)
    {
        $this->generator = $generator(...);
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return ($this->generator)();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return iterator_to_array($this);
    }
}