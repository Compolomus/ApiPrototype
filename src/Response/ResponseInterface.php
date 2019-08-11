<?php declare(strict_types=1);

namespace Compolomus\Prototype\Response;

interface ResponseInterface
{
    public function set(array $data): ResponseInterface;

    public function get();
}
