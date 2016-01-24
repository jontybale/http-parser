<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:17
 */

namespace JontyBale\HttpParser\Model;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Url used to act as a object representing a remote URL which has been retrieved by Guzzle,
 * This is getting a little over engineered...
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class Url implements \JsonSerializable
{

    /** @var RequestInterface */
    protected $request;

    /** @var ResponseInterface */
    protected $response;

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
            'url' => $this->getUrl(),
            'size' => $this->getSizeInKb()
        ];
    }

    /**
     * Construct our URL object.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->request->getUri()->__toString();
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return filter_var($this->response->getHeaderLine('Content-Length'), FILTER_VALIDATE_INT);
    }

    /**
     * Gets size in kilobytes (KB) - assuming 1000 bytes per unit, depends on who's asking...
     *
     * @return string
     */
    public function getSizeInKb()
    {
        return number_format(($this->getSize() / 1000), 2, '.', '') . 'KB';
    }

    /**
     * Proxy method to get the body content.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getResponseContents()
    {
        return $this->response->getBody()->getContents();
    }
}