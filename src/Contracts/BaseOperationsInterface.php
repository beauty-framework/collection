<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface BaseOperationsInterface
{
    /**
     * @param mixed $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(mixed $key, mixed $default = null): mixed;

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function put(mixed $key, mixed $value): void;

    /**
     * @param mixed $key
     * @return bool
     */
    public function has(mixed $key): bool;
    /**
     * @param mixed $key
     * @return void
     */
    public function remove(mixed $key): void;
}