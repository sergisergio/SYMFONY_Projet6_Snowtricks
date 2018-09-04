<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 02/09/2018
 * Time: 21:27
 */

namespace App\Tests\Utils;


use App\Utils\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}