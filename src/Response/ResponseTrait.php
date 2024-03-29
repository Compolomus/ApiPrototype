<?php declare(strict_types=1);

namespace Compolomus\Prototype\Response;

trait ResponseTrait
{
    private $data;

    public function __construct(array $data)
    {
        $this->set($data);
    }

    abstract public function set(array $data);

    public function get()
    {
        return $this->data;
    }
}
