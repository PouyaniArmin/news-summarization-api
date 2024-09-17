<?php

use PHPUnit\Framework\TestCase;
use Yooper\Nicknames;

/**
 *
 * @author dcardin
 */
class NicknamesTest extends TestCase
{
    public function testNames()
    {
        $nicknames = new Nicknames();
        $r = $nicknames->query('joe');
        $this->assertCount(2, $r);
        $this->assertEquals(['joseph','joey'], $r);
    }
    
    public function testNamesFuzzy()
    {
        $nicknames = new Nicknames();
        $r = $nicknames->fuzzy('oe');
        $this->assertCount(6, $r);
    }    
    
}
