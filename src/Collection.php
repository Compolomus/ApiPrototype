<?php declare(strict_types=1);

namespace Compolomus\Prototype;

class Collection
{
    public const ASC = 0;
    public const DESC = 1;

    private $collection;

    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    private function cmp(array $array, string $key, int $sort = Collection::ASC): array
    {
        return uasort($array, static function(array $a, array $b) use ($key, $sort) {
            return $sort ? $a[$key] <=> $b[$key] : $b[$key] <=> $a[$key];
        });
    }

    public function sort(string $key, $sort = Collection::ASC): self
    {
        $collection = $this->cmp($this->collection, $key, $sort);

        return new self($collection);
    }

    public function limit(int $limit, int $offset = 0): self
    {
        $collection = array_slice($this->collection, $offset, $limit);

        return new self($collection);
    }

    public function get(): array
    {
        return $this->collection;
    }
}
