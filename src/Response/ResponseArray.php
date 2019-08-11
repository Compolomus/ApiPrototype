<?php declare(strict_types=1);

namespace Compolomus\Prototype\Response;

class ResponseArray implements ResponseInterface
{
    use ResponseTrait;

    public function set(array $data): ResponseInterface
    {
        $this->data = $data;

        return $this;
    }
}
