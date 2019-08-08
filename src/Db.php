<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use Compolomus\Prototype\Drivers\DriverInterface;

class Adapter implements DriverInterface
{
    private $driver;

    public function __construct(string $table, string $driver)
    {
        $this->driver = new Driver($driver, $table);
    }

    public function create(array $keys, array $values): bool
    {
        return $this->driver->get()->create($keys, $values);
    }

    public function read(array $conditions = []): Collection
    {
        return $this->driver->get()->read($conditions);
    }

    public function update(array $keys, array $values, array $where = []): bool
    {
        return $this->driver->get()->update($keys, $values, $where);
    }

    public function delete(array $where = []): int
    {
        return $this->driver->get()->delete($where);
    }

    public function drop(): bool
    {
        $this->driver->get()->drop();
    }

    public function truncate(): bool
    {
        $this->driver->get()->truncate();
    }

//    public function install(): bool
//    {
//        $this->driver->get()->install();
//    }
}