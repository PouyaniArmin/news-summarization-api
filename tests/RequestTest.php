<?php

namespace Tests;

use App\Core\Request;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;

class RequestTest extends TestCase
{
    protected Request $request;
    protected function setUp(): void
    {
        $this->request = new Request();
    }

    public function testPathReturnsSanitizedUrl()
    {
        $_SERVER['REQUEST_URI'] = '/test-path';
        $this->assertEquals('/test-path', $this->request->path());
    }

    public function testPathRemovesQueryParameters()
    {
        $_SERVER['REQUEST_URI'] = '/test-path?query=example';
        $this->assertEquals('/test-path', $this->request->path());
    }

    public function testPathReturnsRootIfEmpty()
    {
        $_SERVER['REQUEST_URI'] = '';
        $this->assertEquals('/', $this->request->path());
    }
    public function testIsPostReturnsTrueForGetMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertTrue($this->request->isGet());
    }
    public function testBodyReturnsSanitizedGetData()
    {
        $_GET = ['name' => 'Test'];
        $this->assertEquals(['name' => 'Test'], $this->request->body());
    }
    public function testIsPostReturnsTrueForPostMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue($this->request->isPost());
    }
    public function testBodyReturnsSanitizedPostData()
    {
        $_POST = ['name' => 'Test'];
        $this->assertEquals(['name' => 'Test'], $this->request->body());
    }
}
