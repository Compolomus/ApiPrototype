<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use Compolomus\Prototype\Response\ResponseInterface;
use InvalidArgumentException;

class Api
{
    private const ACCESS_CONDITIONS = ['read', 'update', 'delete'];

    private const ACCESS_KEYS_VALUES = ['create', 'update'];

    private const TABLES = ['users', 'files', 'likes', 'structure', 'subjects', 'tags'];

    private $prefix;

    private $db;

    private $result;

    private $response;

    public function __construct(array $config, array $db_config)
    {
        $this->db = (new Db($config['db_driver'], $db_config[$config['db_driver']]))->get();
        $this->prefix = $config['prefix'] ? $config['prefix'] . '_' : '';
        $this->response = new Response($config['response']);
    }

    /**
     * @param string $type
     * @param array $query
     * @return InvalidArgumentException|null
     */
    private function checkType(string $type, array $query): ?InvalidArgumentException
    {
        if (array_key_exists($type, self::ACCESS_CONDITIONS) && !array_key_exists('conditions', $query)) {
            throw new InvalidArgumentException('Not found conditions');
        }
        if (array_key_exists($type, self::ACCESS_KEYS_VALUES) && !array_key_exists('keys', $query) && !array_key_exists('values', $query)) {
            throw new InvalidArgumentException('Not found keys or values');
        }

        return null;
    }

    /**
     * @param string $table
     * @param string $type
     * @param array $query
     * @throws InvalidArgumentException
     * @return Api
     */
    public function request(string $table, string $type, array $query): self
    {
        if (!in_array($table, self::TABLES, true)) {
            throw new InvalidArgumentException('Underfined table ' . $table);
        }
        $this->checkType($type, $query);

        $table = 'Compolomus\\Prototype\\ApiMethods\\' . ucfirst($table);
        $this->result = (new $table($query, $this->prefix, $this->db))->$type()->get();

        return $this;
    }

    public function get()
    {
        // Response
        return $this->response->set(['data' => $this->result->get()])->get();
    }
}
