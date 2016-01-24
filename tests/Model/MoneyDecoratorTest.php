<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:50
 */

namespace JontyBale\HttpParser\Tests\Model;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use JontyBale\HttpParser\Model\MoneyDecorator;
use JontyBale\HttpParser\Model\Product;
use JontyBale\HttpParser\Model\Url;
use Money\Currency;
use Money\Money;

class MoneyDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test UnitPrice getter to ensure we are getting a correct Money unit back.
     */
    public function testToåString()
    {
        $expectedString = '2.50';
        $sut = new MoneyDecorator(new Money(250, new Currency('GBP')));
        $this->assertEquals($expectedString, $sut->__toString());

        $expectedString = '12345.67';
        $sut = new MoneyDecorator(new Money(1234567, new Currency('GBP')));
        $this->assertEquals($expectedString, $sut->__toString());
    }
}