<?php declare(strict_types=1);

namespace Compolomus\Prototype;

use PHPUnit\Framework\TestCase;

class ConfiguratorTest extends TestCase
{

    /**
     * @var Configurator
     */
    private $configurator;

    protected function setUp()
    {
        $this->configurator = new Configurator();
    }

    public function test__construct()
    {
        try {
            $this->assertInternalType('object', $this->configurator);
            $this->assertInstanceOf(Configurator::class, $this->configurator);
        } catch (\Exception $e) {
            $this->assertContains('Must be initialized ', $e->getMessage());
        }
    }

    public function testSetComments()
    {
        $this->configurator->setComments(true);
        $this->assertTrue($this->configurator->getConfig()['comments']);
    }

    public function testSetAttachFiles()
    {
        $this->configurator->setAttachFiles(true);
        $this->assertTrue($this->configurator->getConfig()['attach']);
    }

    public function testSetLikes(): void
    {
        $this->configurator->setLikes(true);
        $this->assertTrue($this->configurator->getConfig()['like']);
    }

    public function testSetPrefix(): void
    {
        $prefix = 'prefix';
        $this->configurator->setPrefix($prefix);
        $this->assertEquals($this->configurator->getConfig()[$prefix], $prefix);
    }

    public function testSetTag(): void
    {
        $this->configurator->setTags(true);
        $this->assertTrue($this->configurator->getConfig()['tag']);
    }

    public function testGetConfig(): void
    {
        $this->configurator->setPrefix('prefix');
        $this->configurator->setAttachFiles(true);
        $this->configurator->setLikes(true);
        $this->configurator->setTags(true);
        $this->configurator->setComments(true);
        $this->assertArraySubset(['prefix' => 'prefix', 'like' => true, 'comments' => true, 'attach' => true, 'tag' => true], $this->configurator->getConfig());
    }

    public function testSave(): void
    {
        $file = 'settings';
        $this->configurator->setPrefix('prefix');
        $this->configurator->setAttachFiles(true);
        $this->configurator->setLikes(true);
        $this->configurator->setComments(true);
        $this->configurator->save($file);
        $this->assertFileExists($file . '.php');
        unlink($file . '.php');
    }
}
