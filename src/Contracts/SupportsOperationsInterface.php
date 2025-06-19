<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface SupportsOperationsInterface
{
    /**
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback): static;

    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback): static;

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function filter(?callable $callback = null): static;

    /**
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    public function where(string $field, mixed $value): static;

    /**
     * @param string|callable $callback
     * @param string $direction
     * @return $this
     */
    public function sortBy(string|callable $callback, string $direction = 'asc'): static;

    /**
     * @return $this
     */
    public function values(): static;
}