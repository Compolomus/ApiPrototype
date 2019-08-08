<?php declare(strict_types=1);

namespace Compolomus\Prototype\Drivers;

use Compolomus\Prototype\Collection;

class MysqlDriver implements DriverInterface
{
    private $table;

    private $pdo;

    public function __construct(string $table, \PDO $pdo)
    {
        $this->table = $table;
        $this->pdo = $pdo;
    }

    public function create(array $keys, array $values): bool
    {
        $sql = 'INSERT INTO `' . $this->table
            . '` (`' . implode('`, `', $keys) . '`)'
            . ' VALUES("' . implode('\", \"',
                array_map(static function (string $key): string {
                    return ':' . $key;
                }, $keys)) . '")';

        return $this->pdo->prepare($sql)->execute($values);
    }

    private function conditions(array $conditions): string
    {
        $sql = '';
        $sql .= $conditions['where'] ? ' WHERE ' . $conditions['where'] : '';
        $sql .= $conditions['order'] ? ' ORDER BY ' . $conditions['order'] : '';
        $sql .= $conditions['limit'] ? ' LIMIT ' . $conditions['limit'] . ' OFFSET ' . $conditions['offset'] : '';

        return $sql;
    }

    public function read(array $conditions = []): Collection
    {
        $sql = 'SELECT * FROM `' . $this->table . '` ';
        $sql .= $this->conditions($conditions);

        $stmt = $this->pdo->prepare($sql)->execute();

        $collection = $stmt->fetchAll();

        return new Collection($collection);
    }

    public function update(array $keys, array $values, array $conditions = []): bool
    {
        $sql = 'UPDATE `' . $this->table . '` SET ';

        $parts = [];

        foreach($keys as $field) {
            $parts[] = '`' . $field . '` = ":' . $field . '"';
        }

        $sql .= count($parts) > 1 ? implode(', ', $parts) : $parts[0];
        $sql .= $this->conditions($conditions);

        return $this->pdo->prepare($sql)->execute($values);
    }

    public function delete(array $conditions = []): int
    {
        $sql = 'DELETE `' . $this->table . '` ';
        $sql .= $this->conditions($conditions);

        return $this->pdo->exec($sql);
    }

    public function drop(): bool
    {
        // TODO: Implement drop() method.
    }

    public function truncate(): bool
    {
        // TODO: Implement truncate() method.
    }


}
