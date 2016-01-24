<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:50
 */

namespace JontyBale\HttpParser\Tests\Command;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use JontyBale\HttpParser\Model\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getting the URL from our request objects.
     */
    public function testGetUrl()
    {
        $expectedUrl = 'http://www.google.com/this-is-a-test-url';
        $request = new Request('GET', $expectedUrl);
        $response = new Response(200, []);

        $sut = new Url($request, $response);

        $this->assertEquals($sut->getUrl(), $expectedUrl);
    }

    /**
     * Test getting the size back from Content-Length in our response object.
     */
    public function testGetSize()
    {
        $expectedUrl = 'http://www.google.com/this-is-a-test-url';
        $expectedSize = 1235122;

        $request = new Request('GET', $expectedUrl);
        $response = new Response(200, ['Content-Length' => $expectedSize]);

        $sut = new Url($request, $response);

        $this->assertEquals($sut->getSize(), $expectedSize);
    }

    /**
     * Testing json serialisation of the Url
     */
    public function testJsonSerialize()
    {
        $expectedSize = 123141;
        $expectedUrl = 'http://www.google.com/let-us-see-what-we-have';
        $expectedJson = json_encode([
            'url' => $expectedUrl,
            'size' => $expectedSize
        ]);

        $request = new Request('GET', $expectedUrl);
        $response = new Response(200, ['Content-Length' => $expectedSize]);

        $sut = new Url($request, $response);

        $this->assertEquals($expectedJson, json_encode($sut));
    }

}