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
class MoneyDecorator
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
     * Format money as a string.
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
}