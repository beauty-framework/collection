<?php
declare(strict_types=1);

namespace Beauty\Collection\Contracts;

interface CollectionInterface extends \IteratorAggregate, \ArrayAccess, \Countable, \JsonSerializable, SupportsOperationsInterface, SupportsAccessorsInterface, BaseOperationsInterface, ArrayableInterface
{
}