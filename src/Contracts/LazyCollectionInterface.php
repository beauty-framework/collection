<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface LazyCollectionInterface extends \IteratorAggregate
{
    /**
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback): static;

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function filter(?callable $callback = null): static;

    /**
     * @param int $limit
     * @return $this
     */
    public function take(int $limit): static;

    /**
     * @param int $size
     * @return $this
     */
    public function chunk(int $size): static;

    /**
     * @param callable $callback
     * @param mixed|null $initial
     * @return mixed
     */
    public function reduce(callable $callback, mixed $initial = null): mixed;

    /**
     * @param callable $callback
     * @return $this
     */
    public function flatMap(callable $callback): static;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return mixed
     */
    public function first(): mixed;
}