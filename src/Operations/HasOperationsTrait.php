<?php
declare(strict_types=1);

namespace Beauty\Collection\Operations;

trait HasOperationsTrait
{
    /**
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback): static
    {
        $result = [];
        foreach ($this as $key => $value) {
            $result[$key] = $callback($value, $key);
        }
        return new static($result);
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function filter(?callable $callback = null): static
    {
        $callback ??= fn($value) => (bool)$value;
        $result = [];
        foreach ($this as $key => $value) {
            if ($callback($value, $key)) {
                $result[$key] = $value;
            }
        }
        return new static($result);
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    public function where(string $field, mixed $value): static
    {
        return $this->filter(function ($item) use ($field, $value) {
            if (is_array($item)) {
                return ($item[$field] ?? null) === $value;
            }

            if (is_object($item)) {
                return ($item->{$field} ?? null) === $value;
            }

            return false;
        });
    }

    /**
     * @param string|callable $callback
     * @param string $direction
     * @return $this
     */
    public function sortBy(string|callable $callback, string $direction = 'asc'): static
    {
        $items = iterator_to_array($this);

        uasort($items, function ($a, $b) use ($callback, $direction) {
            $valueA = is_callable($callback)
                ? $callback($a)
                : (is_array($a) ? $a[$callback] ?? null : $a->{$callback} ?? null);

            $valueB = is_callable($callback)
                ? $callback($b)
                : (is_array($b) ? $b[$callback] ?? null : $b->{$callback} ?? null);

            return $direction === 'asc'
                ? $valueA <=> $valueB
                : $valueB <=> $valueA;
        });

        return new static($items);
    }

    /**
     * @return $this
     */
    public function values(): static
    {
        return new static(array_values(iterator_to_array($this)));
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback): static
    {
        foreach ($this as $key => $value) {
            $callback($value, $key);
        }

        return $this;
    }

}