<?php
declare(strict_types=1);

namespace Beauty\Collection\Operations;

trait HasAccessorsTrait
{
    /**
     * @return mixed
     */
    public function first(): mixed
    {
        // foreach more resource-efficient
        foreach ($this as $value) {
            return $value;
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function last(): mixed
    {
        // If the object supports count(), let's check its size
        $count = ($this instanceof \Countable) ? $this->count() : null;

        if ($count !== null && $count <= 1000) {
            // A small collection — you can just walk through it
            $last = null;
            foreach ($this as $value) {
                $last = $value;
            }
            return $last;
        }

        //For large or unknown items — a faster strategy
        $items = iterator_to_array($this, preserve_keys: false);
        return array_pop($items);
    }
}