<?php declare(strict_types=1);

namespace Compolomus\Prototype;

class Api
{
    private $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function request(string $method, array $params): Response
    {
        $method = 'Api' . ucfirst($method);
        return new $method($params, $this->prefix);
    }
}
