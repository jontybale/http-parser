<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:17
 */

namespace JontyBale\HttpParser\Model;

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

    /** @var Money */
    protected $unitPrice;

    /** @var Url */
    protected $uriMeta;

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}