<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface ArrayableInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}