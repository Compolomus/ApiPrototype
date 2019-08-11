<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use Compolomus\Prototype\Drivers\DriverInterface;
use Compolomus\Prototype\Drivers\Driver;

class Db
{
    private $driver;

    public function __construct(string $driver, array $config)
    {
        $this->driver = new Driver($driver, $config);
    }

    public function get(): DriverInterface
    {
        return $this->driver->get();
    }
}
