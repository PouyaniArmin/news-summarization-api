<?php

namespace Tests;

use App\Core\View;
use PHPUnit\Framework\TestCase;

/**
 * Test class for the View class.
 * This class contains tests to ensure that the render method
 * behaves as expected when rendering views and layouts.
 */
class ViewTest extends TestCase
{
    /**
     * Tests the render method of the View class.
     * Ensures that the rendered output matches the expected HTML structure.
     */
    public function testRender()
    {
        $view = $this->getMockBuilder(View::class)->setConstructorArgs(['home', []])->onlyMethods(['renderLayout', 'renderOnlyView'])->getMock();
        $view->method('renderLayout')->willReturn('<html><body>{{content}}</body></html>');
        $view->method('renderOnlyView')->willReturn('Hello world');
        $expectedOutput = '<html><body>Hello world</body></html>';
        $this->assertEqualsIgnoringCase($expectedOutput, $view->render());
    }
}
