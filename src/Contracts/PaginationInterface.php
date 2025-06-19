<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface PaginationInterface
{
    /**
     * @param int $perPage
     * @param int $page
     * @return $this
     */
    public function paginate(int $perPage, int $page = 1): static;
}