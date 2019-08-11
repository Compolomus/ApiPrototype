<?php declare(strict_types=1);

namespace Compolomus\Prototype\ApiMethods;

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

        $this->db->table($prefix . basename($this->getTable()));
    }

    public function create(): self
    {
        $this->result = $this->db->create($this->query['keys'], $this->query['values']);

        return $this;
    }

    public function read(): self
    {
        $this->result = $this->db->read($this->query['conditions']);

        return $this;
    }

    public function update(): self
    {
        $this->result = $this->db->update($this->query['keys'], $this->query['values'], $this->query['conditions']);

        return $this;
    }

    public function delete(): self
    {
        $this->result = $this->db->delete($this->query['conditions']);

        return $this;
    }

    public function get()
    {
        return $this->result;
    }
}
