<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 20:20
 */

namespace JontyBale\HttpParser\Model;

use Money\Money;

/**
 * Decorate and return a GPB string from a Money object.
 *
 * @package JontyBale\HttpParser\Model
 */
class MoneyDecorator implements \JsonSerializable
{
    /** @var Money */
    private $money;

    /**
     * @param Money $money
     */
    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    /**
     * Format money as a string - using this format as requirements are as a pound/pence
     * value with two decimal places - a float ill get reformatted as a JSON number (eg. 1.50 as 1.5).
     */
    public function __toString()
    {
        return number_format(
            $this->money->getAmount() / 100,
            2,
            '.',
            '' // no thousands comer
        );
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return $this->__toString();
    }
}