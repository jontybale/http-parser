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
use JontyBale\HttpParser\Model\ProductList;
use JontyBale\HttpParser\Model\Url;
use Money\Currency;
use Money\Money;

class ProductListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Helper to create a basic product, allow overiding as required.
     *
     * @param string $price
     * @return Product
     */
    private function getExampleProduct($price = null)
    {
        $title = 'Product 1 Title';
        $description = 'Product 1 Description';
        $price = is_null($price) ? '2.50' : $price;
        $uri = 'http://product1.com';
        $request = new Request('GET', $uri);
        $size = 97961231;
        $response = new Response(200, ['Content-Length' => $size]);
        $url = new Url($request, $response);
        return new Product($title, $description, $price, $url);
    }

    /**
     * Test adding a product to the list.
     */
    public function testAddProduct()
    {
        $sut = new ProductList();
        $this->assertCount(0, $sut->getProducts());
        $sut->addProduct($this->getExampleProduct());
        $this->assertCount(1, $sut->getProducts());
    }

    public function testGetTotal()
    {
        $p1 = $this->getExampleProduct('1.50');
        $p2 = $this->getExampleProduct('8.82');
        $p3 = $this->getExampleProduct('1047.82');

        $sut = new ProductList();
        $this->assertEquals(new Money(0, new Currency('GBP')), $sut->getTotal());

        $sut->addProduct($p1);
        $this->assertEquals(new Money(150, new Currency('GBP')), $sut->getTotal());

        $sut->addProduct($p2);
        $this->assertEquals(new Money(1032, new Currency('GBP')), $sut->getTotal());

        $sut->addProduct($p3);
        $this->assertEquals(new Money(105814, new Currency('GBP')), $sut->getTotal());
    }

    public function testGetTotalInGBP()
    {
        $p1 = $this->getExampleProduct('1.50');
        $p2 = $this->getExampleProduct('8.82');
        $p3 = $this->getExampleProduct('1047.82');

        $sut = new ProductList();
        $this->assertEquals('0.00', $sut->getTotalInGBP());

        $sut->addProduct($p1);
        $this->assertEquals('1.50', $sut->getTotalInGBP());

        $sut->addProduct($p2);
        $this->assertEquals('10.32', $sut->getTotalInGBP());

        $sut->addProduct($p3);
        $this->assertEquals('1058.14', $sut->getTotalInGBP());
    }

    /**
     * Json JsonSeralise method.
     */
    public function testJsonSerialize()
    {
        // product 1
        $p1Title = 'Product 1 Title';
        $p1Description = 'Product 1 Description';
        $p1UnitPrice = '1.80';
        $p1Uri = 'http://product1.com';
        $p1Request = new Request('GET', $p1Uri);
        $p1Size = 97961231;
        $p1Response = new Response(200, ['Content-Length' => $p1Size]);
        $p1Url = new Url($p1Request, $p1Response);
        $p1 = new Product($p1Title, $p1Description, $p1UnitPrice, $p1Url);

        // product 2
        $p2Title = 'Product 2 Title';
        $p2Description = 'Product 2 Description';
        $p2UnitPrice = '2.20';
        $p2Uri = 'http://product2.com';
        $p2Request = new Request('GET', $p2Uri);
        $p2Size = 12351231;
        $p2Response = new Response(200, ['Content-Length' => $p2Size]);
        $p2Url = new Url($p2Request, $p2Response);
        $p2 = new Product($p2Title, $p2Description, $p2UnitPrice, $p2Url);

        // json
        $expectedJson = json_encode(
            (object) [
                'results' => [
                    (object) [
                        'title' => $p1Title,
                        'size' => $p1Size,
                        'unit_price' => $p1UnitPrice,
                        'description' => $p1Description
                    ],
                    (object) [
                        'title' => $p2Title,
                        'size' => $p2Size,
                        'unit_price' => $p2UnitPrice,
                        'description' => $p2Description
                    ],
                ],
                'total' => '4.00'
            ]
        );

        $sut = new ProductList();
        $sut->addProduct($p1);
        $sut->addProduct($p2);

        $this->assertEquals($expectedJson, json_encode($sut));
    }

}