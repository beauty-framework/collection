<?php
declare(strict_types=1);

namespace Beauty\Collection\Operations;

trait HasPaginationTrait
{
    /**
     * @param int $perPage
     * @param int $page
     * @return $this
     */
    public function paginate(int $perPage, int $page = 1): static
    {
        $items = iterator_to_array($this);
        $offset = max(0, ($page - 1) * $perPage);
        $chunk = array_slice($items, $offset, $perPage, true);

        return new static($chunk);
    }
}