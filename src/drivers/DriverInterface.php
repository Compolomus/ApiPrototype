<?php declare(strict_types=1);

namespace Compolomus\Prototype\Drivers;

interface DriverInterface
{
    public function table(?string $table = null): string;

    public function get();

    public function create(array $keys, array $values): DriverInterface;

    public function read(array $conditions = []): DriverInterface;

    public function update(array $keys, array $values, array $conditions = []): DriverInterface;

    public function delete(array $conditions = []): DriverInterface;

    public function drop(): DriverInterface;

    public function truncate(): DriverInterface;
}
