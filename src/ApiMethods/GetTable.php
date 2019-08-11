<?php declare(strict_types=1);

namespace Compolomus\Prototype\ApiMethods;

trait GetTable
{
    public function getTable(): string
    {
        return strtolower(__CLASS__);
    }
}
