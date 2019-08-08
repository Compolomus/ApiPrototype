<?php declare(strict_types=1);

namespace Compolomus\Prototype\Drivers;

use Compolomus\Prototype\Collection;

interface DriverInterface
{
    public function create(array $keys, array $values): bool;

    public function read(array $conditions = []): Collection;

    public function update(array $keys, array $values, array $conditions = []): bool;

    public function delete(array $conditions = []): int;

    public function drop(): bool;

    public function truncate(): bool;
}
