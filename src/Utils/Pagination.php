<?php declare(strict_types=1);

namespace Compolomus\Prototype\Utils;

class Pagination
{
    private $total;

    private $page;

    private $limit;

    private $totalPages;

    private $length;

    /**
     * Pagination constructor.
     * @param int $page
     * @param int $limit
     * @param int $total
     * @param int $length
     */
    public function __construct(int $page, int $limit, int $total, int $length = 3)
    {
        $this->page = $page >= 1 ? $page : 1;
        $this->limit = $limit >= 1 ? $limit : 10;
        $this->total = $total;
        $this->totalPages = (int)ceil($total / $limit);
        $this->length = $length >= 0 ? $length : 3;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getEnd(): int
    {
        return $this->page === $this->totalPages ? $this->total : $this->page * $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->page === 1 ? 0 : ($this->page - 1) * $this->limit;
    }

    /**
     * @return array
     */
    private function leftPad(): array
    {
        $result = [];

        $result[2] = $leftDots = $this->page - $this->length >= 3 ? '...' : 0;

        for ($x = $this->length, $i = $this->page - 1; $i > ($leftDots ? $this->page - $this->length - 1 : 2); $x--, $i--) {
            $result[$i] = $i;
        }

        return $result;
    }

    /**
     * @return array
     */
    private function rightPad(): array
    {
        $result = [];

        $result[$this->totalPages - 1] = $rightDots = $this->page + $this->length <= $this->totalPages - 2 ? '...' : 0;

        for ($x = 1, $i = $this->page + 1; $i < ($rightDots ? $this->page + $this->length + 1 : $this->total - 1); $x++, $i++) {
            $result[$i] = $i;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $al = [1 => 'first'];

        $al += $this->leftPad();

        $al[$this->page] = 'current';

        $al += $this->rightPad();

        $al[$this->totalPages] = 'last';

        ksort($al);

        return $al;
    }
}
