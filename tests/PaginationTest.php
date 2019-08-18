<?php declare(strict_types=1);

namespace Compolomus\Prototype\Utils;

use PHPUnit\Framework\TestCase;


class PaginationTest extends TestCase
{

    public function test__construct(): void
    {
        $nav = new Pagination(1, 10, 20);
        try {
            $this->assertInternalType('object', $nav);
            $this->assertInstanceOf(Pagination::class, $nav);
        } catch (\Exception $e) {
            $this->assertContains('Must be initialized ', $e->getMessage());
        }
    }

    public function testGetOffset(): void
    {
        $nav1 = new Pagination(1, 10, 20);
        $nav2 = new Pagination(2, 5, 30);
        $this->assertEquals($nav1->getOffset(), 0);
        $this->assertEquals($nav2->getOffset(), 5);
    }

    public function testGetLimit(): void
    {
        $nav = new Pagination(1, 10, 20);
        $this->assertEquals($nav->getLimit(), 10);
    }

    public function testGet(): void
    {
        $nav1 = new Pagination(-1, 10, 20);
        $nav2 = new Pagination(10, 10, 20, 0);
        $nav3 = new Pagination(5, 10, 200, 5);
        $this->assertCount(2, $nav1->get());
        $this->assertCount(2, $nav2->get());
        $this->assertCount(12, $nav3->get());
    }

    public function testGetEnd(): void
    {
        $nav1 = new Pagination(1, 10, 20);
        $nav2 = new Pagination(2, 20, 30);
        $this->assertEquals($nav1->getEnd(), 10);
        $this->assertEquals($nav2->getEnd(), 30);
    }
}
