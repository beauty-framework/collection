<?php
declare(strict_types=1);

namespace Beauty\Collection;

use Beauty\Collection\Contracts\CollectionInterface;
use Beauty\Collection\Contracts\CollectionStorageInterface;
use Beauty\Collection\Operations\HasAccessorsTrait;
use Beauty\Collection\Operations\HasOperationsTrait;
use Beauty\Collection\Storages\ArrayStorage;
use Beauty\Collection\Storages\DsMapStorage;

class Collection implements CollectionInterface
{
    use HasOperationsTrait, HasAccessorsTrait;

    /**
     * @var CollectionStorageInterface|ArrayStorage|DsMapStorage
     */
    protected CollectionStorageInterface $storage;

    /**
     * @param iterable $items
     */
    public function __construct(iterable $items = [])
    {
        $this->storage = class_exists(\Ds\Map::class)
            ? new DsMapStorage($items)
            : new ArrayStorage($items);
    }

    /**
     * @param mixed $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(mixed $key, mixed $default = null): mixed
    {
        return $this->storage->get($key, $default);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function put(mixed $key, mixed $value): void
    {
        $this->storage->put($key, $value);
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function has(mixed $key): bool
    {
        return $this->storage->has($key);
    }

    /**
     * @param mixed $key
     * @return void
     */
    public function remove(mixed $key): void
    {
        $this->storage->remove($key);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->storage->toArray();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->storage->count();
    }

    /**
     * @return \Traversable
     * @throws \Exception
     */
    public function getIterator(): \Traversable
    {
        return $this->storage->getIterator();
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->put($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}