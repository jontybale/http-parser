<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:17
 */

namespace JontyBale\HttpParser\Model;

/**
 * Class UriMeta used to represent meta data about a URI.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class UriMeta implements \JsonSerializable {

    /** @var string */
    protected $uri;

    /** @var string */
    protected $description;

    /** @var integer */
    protected $size;

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