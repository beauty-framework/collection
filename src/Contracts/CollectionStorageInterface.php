<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface CollectionStorageInterface extends \IteratorAggregate, \Countable, ArrayableInterface, BaseOperationsInterface
{
}