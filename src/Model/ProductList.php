<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:17
 */

namespace JontyBale\HttpParser\Model;

use Money\Currency;
use Money\Money;

/**
 * Class ProductList represnting a set of products
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class ProductList implements \JsonSerializable
{
    /** @var Product[] */
    protected $products = [];

    /**
     * Accessor for products
     *
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add a product!
     *
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * Get total price as a money object.
     *
     * @return Money
     */
    public function getTotal()
    {
        $total = new Money(0, new Currency('GBP'));
        foreach ($this->products AS $product) {
            $total = $total->add($product->getUnitPrice());
        }
        return $total;
    }

    /**
     * Method to return total price as a string with 2 decimal points.
     *
     * @return string
     */
    public function getTotalInGBP()
    {
        return (string) new MoneyDecorator($this->getTotal());
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return (object) [
            'results' => $this->products,
            'total' => $this->getTotalInGBP()
        ];
    }
}