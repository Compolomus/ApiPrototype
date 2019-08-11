<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use Compolomus\Prototype\Response\ResponseInterface;

class Response implements ResponseInterface
{
    private $format;

    private $response;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function set(array $data): ResponseInterface
    {
        $ResponseType = 'Compolomus\\Prototype\\Response\\Response' . ucfirst($this->format);
        $this->response = (new $ResponseType($data))->get();

        return $this;
    }

    public function get()
    {
        return $this->response;
    }
}
