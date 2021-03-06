<?php

namespace Tests\Unit;

use App\BackingClasses\Char;
use PHPUnit\Framework\TestCase;

class CharTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    public function testGetCamelCaseString()
    {
        $char = new Char();

        $out = $char->getCamelCase("call_of_duty");
        self::assertEquals("callOfDuty", $out);

        $out = $char->getCamelCase("change_of_heart");
        self::assertEquals("changeOfHeart", $out);

        $out = $char->getCamelCase("batman_and_robin");
        self::assertEquals("batmanAndRobin", $out);
    }
}
