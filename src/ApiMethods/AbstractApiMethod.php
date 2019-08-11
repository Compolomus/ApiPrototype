<?php declare(strict_types=1);

namespace Compolomus\Prototype\ApiMethods;

use Compolomus\Prototype\Collection;
use Compolomus\Prototype\Drivers\DriverInterface;

abstract class AbstractApiMethod
{
    private $query;

    private $db;

    private $result;

    public function __construct(array $query, string $prefix, DriverInterface $db)
    {
        $this->query = $query;

        $this->db = $db;

        $this->db->table($prefix . '_' . static::getTable());
    }

    abstract public function getTable(): string;

    public function create(): bool
    {
        $this->result = $this->db->create($this->query['keys'], $this->query['values']);
    }

    public function read(): Collection
    {
        $this->result = $this->db->read($this->query['conditions']);
    }

    public function update(): bool
    {
        $this->result = $this->db->update($this->query['keys'], $this->query['values'], $this->query['conditions']);
    }

    public function delete(): int
    {
        return $this->db->delete($this->query['conditions']);
    }

    public function get()
    {
        return $this->result;
    }
}
