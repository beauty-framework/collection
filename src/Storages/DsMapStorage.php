<?php
declare(strict_types=1);

namespace Beauty\Collection\Storages;

use Beauty\Collection\Contracts\CollectionStorageInterface;
use Ds\Map;
use Traversable;

class DsMapStorage implements CollectionStorageInterface
{
    /**
     * @var Map
     */
    protected Map $map;

    /**
     * @param iterable $items
     */
    public function __construct(iterable $items = [])
    {
        $this->map = new Map();
        foreach ($items as $key => $value) {
            $this->map->put($key, $value);
        }
    }

    /**
     * @param mixed $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(mixed $key, mixed $default = null): mixed
    {
        return $this->map->hasKey($key) ? $this->map->get($key) : $default;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function put(mixed $key, mixed $value): void
    {
        $this->map->put($key, $value);
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function has(mixed $key): bool
    {
        return $this->map->hasKey($key);
    }

    /**
     * @param mixed $key
     * @return void
     */
    public function remove(mixed $key): void
    {
        $this->map->remove($key);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->map->toArray();
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return $this->map->getIterator();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->map->count();
    }
}