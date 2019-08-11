<?php declare(strict_types=1);

namespace Compolomus\Prototype;

//use Compolomus\Prototype\ApiMethods\Users;
//use Compolomus\Prototype\ApiMethods\Files;
//use Compolomus\Prototype\ApiMethods\Likes;
//use Compolomus\Prototype\ApiMethods\Structure;
//use Compolomus\Prototype\ApiMethods\Subjects;
//use Compolomus\Prototype\ApiMethods\Tags;
use Compolomus\Prototype\Utils\Config;
use \InvalidArgumentException;

class Api
{
    private const ACCESS_CONDITIONS = ['read', 'update', 'delete'];

    private const ACCESS_KEYS_VALUES = ['create', 'update'];

    private const TYPES = ['create', 'read', 'update', 'delete'];

    private const TABLES = ['users', 'files', 'likes', 'structure', 'subjects', 'tags'];

    private $prefix;

    private $db;

    private $result;

    private $response;

    public function __construct(string $config_filename, $db_config_file)
    {
        $config = (new Config(include $config_filename))->getConfig();
        $db_config = (new Config(include $db_config_file))->getConfig();
        $this->db = new Db($config['db_driver'], $db_config[$config['db_driver']]);
        $this->prefix = $config['prefix'];
        $this->response = new Response($config['response']);
    }

    /**
     * @param string $table
     * @param string $type
     * @param array $query
     */
    public function request(string $table, string $type, array $query): void
    {
        if (!in_array($type, self::TYPES, true)) {
            throw new InvalidArgumentException('Underfined type ' . $type);
        }
        if (!in_array($table, self::TABLES, true)) {
            throw new InvalidArgumentException('Underfined table ' . $table);
        }
        if (!array_key_exists($type, self::ACCESS_CONDITIONS) && !in_array('conditions', $query, true)) {
            throw new InvalidArgumentException('Not found conditions');
        }
        if (!array_key_exists($type, self::ACCESS_KEYS_VALUES) && !in_array('keys', $query, true) && !in_array('values', $query, true)) {
            throw new InvalidArgumentException('Not found keys or values');
        }

        $table = ucfirst($table);
        $this->result = (new $table($query, $this->prefix, $this->db))->$type()->get();
    }

    public function get(): Response
    {
        // Response
        return $this->result;
    }
}
