<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface SupportsAccessorsInterface
{
    /**
     * @return mixed
     */
    public function first(): mixed;

    /**
     * @return mixed
     */
    public function last(): mixed;
}