<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use PHPUnit\Framework\TestCase;


class ConfigTest extends TestCase
{

    /**
     * @var Config
     */
    private $config;

    protected function setUp()
    {
        $this->config = new Config();
    }

    public function test__construct()
    {
        try {
            $this->assertInternalType('object', $this->config);
            $this->assertInstanceOf(Config::class, $this->config);
        } catch (\Exception $e) {
            $this->assertContains('Must be initialized ', $e->getMessage());
        }
    }

    public function testSet(): void
    {
        $this->config->set('dummy', 1);
        $this->assertEquals($this->config->get('dummy'), 1);
    }

    public function testGet(): void
    {
        $this->config->set('dummy', 1);
        $this->assertEquals($this->config->get('dummy'), 1);
    }

    public function testGetConfig(): void
    {
        $this->config->set('dummy', 1);
        $this->assertArraySubset(['dummy' => 1], $this->config->getConfig());
    }

    public function testSave(): void
    {
        $this->config->save('test');
        $this->assertFileExists('test.php');
        unlink('test.php');
    }
}
