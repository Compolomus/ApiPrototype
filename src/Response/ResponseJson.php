<?php declare(strict_types=1);

namespace Compolomus\Prototype\Response;

class ResponseJson implements ResponseInterface
{
    use ResponseTrait;

    public function set(array $data): ResponseInterface
    {
        $this->data = json_encode($data);

        return $this;
    }
}
