<?php declare(strict_types=1);

namespace Compolomus\Prototype;

class Configurator
{
    private $config;

    /**
     * Configurator constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->config['prefix'] = $prefix;
    }

    /**
     * @param bool $comments
     */
    public function setComments(bool $comments): void
    {
        $this->config['comments'] = $comments;
    }

    /**
     * @param bool $attach
     */
    public function setAttachFiles(bool $attach): void
    {
        $this->config['attach'] = $attach;
    }

    /**
     * @param bool $like
     */
    public function setLikes(bool $like): void
    {
        $this->config['like'] = $like;
    }

    public function setTags(bool $tag): void
    {
        $this->config['tag'] = $tag;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        return (new Config($this->getConfig()))->save('settings');
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}
