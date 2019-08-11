<?php declare(strict_types=1);

namespace Compolomus\Prototype\Drivers;

use Compolomus\Prototype\Collection;

class MysqlDriver implements DriverInterface
{
    private $table;

    private $pdo;

    private $result;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function table(?string $table = null): string
    {
        if ($table !== null) {
            $this->table = $table;
        }
        return $this->table;
    }

    public function get()
    {
        return $this->result;
    }

    public function create(array $keys, array $values): DriverInterface
    {
        $sql = 'INSERT INTO `' . $this->table()
            . '` (`' . implode('`, `', $keys) . '`)'
            . ' VALUES(' . implode(', ', array_fill(0, count($keys), '?')) . ')';

        $this->result = $this->pdo->prepare($sql)->execute($values);

        return $this;
    }

    private function conditions(array $conditions): string
    {
        $sql = '';
        $sql .= $conditions['where'] ? ' WHERE ' . $conditions['where'] : '';
        $sql .= $conditions['order'] ? ' ORDER BY ' . $conditions['order'] : '';
        $sql .= $conditions['limit'] ? ' LIMIT ' . $conditions['limit'] . ($conditions['offset'] ? ' OFFSET ' . $conditions['offset'] : '') : '';

        return $sql;
    }

    public function read(array $conditions = []): DriverInterface
    {
        $sql = 'SELECT * FROM `' . $this->table() . '`' . $this->conditions($conditions);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $this->result = new Collection($stmt->fetchAll());

        return $this;
    }

    public function update(array $keys, array $values, array $conditions = []): DriverInterface
    {
        $sql = 'UPDATE `' . $this->table() . '` SET ';

        $parts = [];

        foreach($keys as $field) {
            $parts[] = '`' . $field . '` = ":' . $field . '"';
        }

        $sql .= count($parts) > 1 ? implode(', ', $parts) : $parts[0];
        $sql .= $this->conditions($conditions);

        $this->result = $this->pdo->prepare($sql)->execute($values);

        return $this;
    }

    public function delete(array $conditions = []): DriverInterface
    {
        $sql = 'DELETE `' . $this->table() . '` ';
        $sql .= $this->conditions($conditions);
        $this->result = $this->pdo->exec($sql);

        return $this;
    }

    public function drop(): DriverInterface
    {
        // TODO: Implement drop() method.
        return $this;
    }

    public function truncate(): DriverInterface
    {
        // TODO: Implement truncate() method.
        return $this;
    }
}
