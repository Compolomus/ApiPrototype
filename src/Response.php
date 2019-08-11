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

    public function set(array $data): void
    {
        $ResponseName = 'Response' . ucfirst($this->format);
        $this->response = (new $ResponseName($data))->get();
    }

    public function get(): ResponseInterface
    {
        return $this->response;
    }
}
