<?php declare(strict_types=1);

namespace Compolomus\Prototype\Response;

trait ResponseTrait
{
    private $data;

    public function __construct(array $data)
    {
        $this->set($data);
    }

    public function get(): array
    {
        return $this->data;
    }
}
