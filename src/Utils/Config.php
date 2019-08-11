<?php declare(strict_types=1);

namespace Compolomus\Prototype\Utils;

class Config
{
    private $config;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }

    /**
     * @param string $key
     * @param $value
     * @return Config
     */
    public function set(string $key, $value): self
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param $filename
     * @param array $data
     * @return bool
     */
    public function save($filename, array $data = []): bool
    {
        return (bool) file_put_contents($filename . '.php',
            "<?php\n\n" . 'return ' . var_export((!count($data) ? $this->config : $data), true) . ";\n");
    }
}
