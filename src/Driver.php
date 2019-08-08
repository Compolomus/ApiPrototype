<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use Compolomus\Prototype\Drivers\DriverInterface;

class Driver
{
    private $driver;

    public function __construct(string $table, string $driver)
    {
        $driver = \ucfirst($driver) . 'Driver';

        $config = (new Config(include '.config/db_config.php'))->getConfig()[$driver];

        // add drivers
        $dsn = [
            'mysql' =>
                'mysql:host=' . $config['host'] . ';dbname=' . $config['name'],
        ];

        $pdo = new \PDO($dsn[$driver], $config['username'], $config['password'],
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4_general_ci'",
                \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
            ]
        );

        $this->driver = new $driver($table, $pdo);
    }

    public function get(): DriverInterface
    {
        return $this->driver;
    }
}
