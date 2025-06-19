<?php
declare(strict_types=1);

namespace Beauty\Collection\Storages;

use Beauty\Collection\Contracts\CollectionStorageInterface;

class ArrayStorage implements CollectionStorageInterface
{
    /**
     * @var array
     */
    protected array $items = [];

    /**
     * @param iterable $items
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $key => $value) {
            $this->items[$key] = $value;
        }
    }

    /**
     * @param mixed $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(mixed $key, mixed $default = null): mixed
    {
        return $this->items[$key] ?? $default;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function put(mixed $key, mixed $value): void
    {
        $this->items[$key] = $value;
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function has(mixed $key): bool
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * @param mixed $key
     * @return void
     */
    public function remove(mixed $key): void
    {
        unset($this->items[$key]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }
}