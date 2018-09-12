<?php
/**
 * Created by PhpStorm.
 * User: Barbazul
 * Date: 12/9/2018
 * Time: 3:26 PM
 */

namespace SemExpert\FixSalesDecimals\Integration;

use PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{
    public function testFail()
    {
        $this->fail();
    }

    public function testSuccess()
    {
        $this->assertTrue(true);
    }

    public function testSkip()
    {
        $this->markTestSkipped();
    }

    public function testIncomplete()
    {
        $this->markTestIncomplete();
    }
}
