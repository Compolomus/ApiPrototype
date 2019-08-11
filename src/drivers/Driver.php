<?php declare(strict_types=1);

namespace Compolomus\Prototype\Drivers;

class Driver
{
    private $driver;

    public function __construct(string $driver, array $config)
    {
        $driver = \ucfirst($driver) . 'Driver';

        // add drivers
        $args = [
            'mysql' =>
                'mysql:host=' . $config['host'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4_general_ci'",
                    \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
                ],
            'sqlite' =>
            '',
        ];

        $pdo = new \PDO(...$args[$driver]);

        $this->driver = new $driver($pdo);
    }

    public function get(): DriverInterface
    {
        return $this->driver;
    }
}
