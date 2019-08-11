<?php declare(strict_types=1);

namespace Compolomus\Prototype\Drivers;

use PDO;
use Compolomus\Prototype\Drivers\MysqlDriver;

class Driver
{
    private $driver;

    public function __construct(string $driver, array $config)
    {
        // add drivers
        $args = [
            'mysql' => [
                'dsn' => 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
                'username' => $config['username'],
                'password' => $config['password'],
                'options' => [
                    PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
                ],
            ],
            'sqlite' =>
                '',
        ];

        $pdo = new PDO($args[$driver]['dsn'], $args[$driver]['username'], $args[$driver]['password'], $args[$driver]['options']);

        $driver = 'Compolomus\\Prototype\\Drivers\\' . ucfirst($driver) . 'Driver';

        $this->driver = new $driver($pdo);
    }

    public function get(): DriverInterface
    {
        return $this->driver;
    }
}
