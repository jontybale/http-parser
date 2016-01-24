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
 * Class Product representing a product which has been scraped from a URI.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class Product implements \JsonSerializable
{

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var Money */
    protected $unitPrice;

    /** @var Url */
    protected $url;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Money
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Helper to get back to GBP as string from our Money object.
     *
     * @return string
     */
    public function getUnitPriceInGBP()
    {

        return (string) new MoneyDecorator($this->getUnitPrice());
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Create a product object.
     *
     * @param $title
     * @param $description
     * @param $unitPrice
     * @param Url $url
     */
    public function __construct($title, $description, $unitPrice, Url $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;

        $unitPriceInPence = intval($unitPrice * 100);
        $this->unitPrice = new Money($unitPriceInPence, new Currency('GBP'));
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
            'title' => $this->getTitle(),
            'size' => $this->getUrl()->getSize(),
            'unit_price' => $this->getUnitPriceInGBP(),
            'description' => $this->getDescription()
        ];
    }
}