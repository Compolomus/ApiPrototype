<?php declare(strict_types=1);

namespace Compolomus\Prototype\Utils;

class Template
{
    private $dir;

    private $ext;

    public function __construct(string $dir, string $ext)
    {
        $this->dir = $dir;
        $this->ext = $ext;
    }

    public function __call(string $name, array $arguments)
    {
        $action = substr($name, 0, 3);
        $property = strtolower(substr($name, 3));
        switch ($action) {
            case 'get':
                return $this->$property;

            case 'set':
                $this->$property = $arguments[0];
                break;

            default :
                return false;
        }
    }

    public function args(array $args)
    {
        return call_user_func_array(array($this, 'render'), $args);
    }

    public function render(string $tpl, array $data = [])
    {
        if (count($data)) {
            foreach ($data as $key => $val) {
                $k = 'set' . $key;
                $this->$k($val);
            }
        }

        ob_start();
        if (is_file($this->dir . DIRECTORY_SEPARATOR . $tpl . '.' . $this->ext)) {
            include $this->dir . DIRECTORY_SEPARATOR . $tpl . '.' . $this->ext;
        } else {
            echo '<h1>Tpl debug<h1><pre>' . print_r($data, true) . '</pre>';
        }

        return ob_get_clean();
    }
}
