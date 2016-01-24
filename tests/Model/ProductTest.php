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
use JontyBale\HttpParser\Model\Product;
use JontyBale\HttpParser\Model\Url;
use Money\Currency;
use Money\Money;

class ProductTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test UnitPrice getter to ensure we are getting a correct Money unit back.
     */
    public function testGetUnitPrice()
    {
        $expectedPrice = new Money(250, new Currency('GBP'));
        $title = 'Product 1 Title';
        $description = 'Product 1 Description';
        $price = '250';
        $uri = 'http://product1.com';
        $request = new Request('GET', $uri);
        $size = 97961231;
        $response = new Response(200, ['Content-Length' => $size]);
        $url = new Url($request, $response);

        $sut = new Product($title, $description, $price, $url);
        $actualPrice = $sut->getUnitPrice();

        $this->assertInstanceOf('Money\Money', $actualPrice);
        $this->assertEquals($expectedPrice, $actualPrice);
    }

    /**
     * Test to ensure that our accessor to retrieve the string price value in GBP works
     * as expected.
     */
    public function testGetUnitPriceInGBP()
    {
        $expectedPrice = '1.80';

        $price = '180';
        $title = 'Product 1 Title';
        $description = 'Product 1 Description';
        $uri = 'http://product1.com';
        $request = new Request('GET', $uri);
        $size = 97961231;
        $response = new Response(200, ['Content-Length' => $size]);
        $url = new Url($request, $response);

        $sut = new Product($title, $description, $price, $url);
        $price = $sut->getUnitPriceInGBP();

        $this->assertEquals($expectedPrice, $price);
    }

}