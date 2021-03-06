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
     * Create a product object - could do with some more input filtering.
     *
     * @param $title
     * @param $description
     * @param $unitPriceInPence
     * @param Url $url
     */
    public function __construct($title, $description, $unitPriceInPence, Url $url)
    {
        $this->title = trim($title);
        $this->description = trim($description);
        $this->url = $url;
        $this->unitPrice = new Money(
            intval(filter_var($unitPriceInPence, FILTER_SANITIZE_NUMBER_INT)),
            new Currency('GBP')
        );
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
            'size' => $this->getUrl()->getSizeInKb(),
            'unit_price' => $this->getUnitPriceInGBP(),
            'description' => $this->getDescription()
        ];
    }
}