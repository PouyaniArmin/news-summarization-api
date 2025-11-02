<?php

namespace Tests;

use App\Controllers\HomeController;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use Exception;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    protected Request $request;
    protected Response $response;
    public Router $router;
    public function setUp(): void
    {
        $this->request = $this->getMockBuilder(Request::class)->onlyMethods(['path', 'method'])->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $this->router = new Router($this->request, $this->response);
    }
    public function testGetRouterRegistertion()
    {
        $callback = $this->handelCallback();
        $this->registerassertSameRouter($callback, '/', 'get');
        $this->registerHasArrayRouter('/home', 'get');
    }
    public function testPostRouterRegistertion()
    {
        $callback = $this->handelCallback();
        $this->registerassertSameRouter($callback, '/', 'post');
        $this->registerHasArrayRouter('/home', 'post');
    }
    public function testDeleteRouterRegistertion()
    {
        $callback = $this->handelCallback();
        $this->registerassertSameRouter($callback, '/', 'delete');
        $this->registerHasArrayRouter('/home', 'delete');
    }
    public function testPutRouterRegistertion()
    {
        $callback = $this->handelCallback();
        $this->registerassertSameRouter($callback, '/', 'put');
        $this->registerHasArrayRouter('/home', 'put');
    }
    private function registerassertSameRouter($callback, $path, $method)
    {
        $this->router->{$method}($path, $callback);
        $this->assertArrayHasKey($path, $this->router->routers[$method]);
        $this->assertSame($callback, $this->router->routers[$method][$path]);
    }
    private function registerHasArrayRouter($path, $method)
    {
        $this->router->{$method}($path, [HomeController::class, 'index']);
        $this->assertArrayHasKey($path, $this->router->routers[$method]);
        $this->assertEquals([HomeController::class, 'index'], $this->router->routers[$method][$path]);
    }
    private function handelCallback()
    {
        return function () {
            return "Hello World";
        };
    }
}
