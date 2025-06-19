# Beauty Collection

A powerful collection abstraction for the Beauty Framework.  
Supports both eager and lazy data pipelines, multiple storage strategies, method chaining (`map`, `filter`, `sortBy`, `paginate`, etc.), strict interfaces, and full compatibility.

---

## Features

### `Collection` (eager)
- Fluent methods:
    - `map`, `filter`, `where`, `sortBy`, `paginate`, `each`, `first`, `last`, `values`
- Implements:
    - `ArrayAccess`, `Countable`, `IteratorAggregate`, `JsonSerializable`
- Smart `last()` optimization (iterator or buffered strategy)
- Storage strategies:
    - `ArrayStorage` (default)
    - `DsMapStorage` (if `ext-ds` is available)

### `LazyCollection`
- Based on `Generator`
- Fluent methods:
    - `map`, `filter`, `chunk`, `flatMap`, `reduce`, `take`, `first`, `toArray`
- Memory efficient for large or infinite datasets

### Interfaces
- `CollectionInterface`
- `SupportsOperations`
- `SupportsAccessors`
- `LazyCollectionInterface`

---

## Installation

```bash
composer require beauty-framework/collection
```

---

### Usage
**Eager Collection**
```php
$collection = new Collection([
  ['name' => 'Kirill'],
  ['name' => 'Hui'],
  ['name' => 'Zver'],
]);

$filtered = $collection
    ->where('name', 'Kirill')
    ->map(fn($x) => strtoupper($x['name']))
    ->toArray();
```

**Lazy Collection**
```php
$collection = new LazyCollection(fn() => yield from range(1, 1_000_000));

$result = $collection
    ->filter(fn($x) => $x % 2 === 0)
    ->take(5)
    ->flatMap(fn($x) => [$x, $x * 10])
    ->toArray();
```

---

## Tests
```bash
vendor/bin/phpunit
```

---

## Compatibility
- ArrayAccess
- Countable
- IteratorAggregate
- JsonSerializable

## License
MIT