<?php
declare(strict_types=1);

namespace Beauty\Collection\Operations;

use Generator;

trait ImplementsLazyTrait
{
    /**
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback): static
    {
        return new static(function () use ($callback) {
            foreach ($this as $key => $value) {
                yield $key => $callback($value, $key);
            }
        });
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function filter(?callable $callback = null): static
    {
        $callback ??= fn($v) => (bool) $v;

        return new static(function () use ($callback) {
            foreach ($this as $key => $value) {
                if ($callback($value, $key)) {
                    yield $key => $value;
                }
            }
        });
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function take(int $limit): static
    {
        return new static(function () use ($limit) {
            $i = 0;
            foreach ($this as $key => $value) {
                if ($i++ >= $limit) break;
                yield $key => $value;
            }
        });
    }

    /**
     * @param int $size
     * @return $this
     */
    public function chunk(int $size): static
    {
        return new static(function () use ($size) {
            $chunk = [];
            $i = 0;

            foreach ($this as $key => $value) {
                $chunk[$key] = $value;
                if (++$i === $size) {
                    yield $chunk;
                    $chunk = [];
                    $i = 0;
                }
            }

            if ($chunk !== []) {
                yield $chunk;
            }
        });
    }

    /**
     * @param callable $callback
     * @param mixed|null $initial
     * @return mixed
     */
    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        $acc = $initial;
        foreach ($this as $key => $value) {
            $acc = $callback($acc, $value, $key);
        }
        return $acc;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function flatMap(callable $callback): static
    {
        return new static(function () use ($callback) {
            foreach ($this as $value) {
                $items = $callback($value);
                foreach ($items as $subValue) {
                    yield $subValue;
                }
            }
        });
    }

    /**
     * @return mixed
     */
    public function first(): mixed
    {
        foreach ($this as $value) {
            return $value;
        }

        return null;
    }
}