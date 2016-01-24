<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:50
 */

namespace JontyBale\HttpParser\Tests\Command;

use JontyBale\HttpParser\Service\HttpFetch;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;



class HttpFetchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test should fetch data from a URL and return a Url object with the same URL.
     */
    public function testGetUrl()
    {
        // setup our url and mock guzzle
        $expectedUrl = 'http://www.google.com/this-is-a-test';
        $expectedSize = 34512;
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Length' => $expectedSize]),
        ]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);
        $sut = new HttpFetch($client);

        $url = $sut->fetchUrl($expectedUrl);

        $this->assertEquals($url->getUrl(), $expectedUrl);
        $this->assertEquals($url->getSize(), $expectedSize);
    }

    public function testAttachConsoleOutput()
    {
        // setup our url and mock guzzle
        $expectedUrl = 'http://www.google.com/this-is-a-test';
        $mockHandler = new MockHandler([
            new Response(200),
        ]);
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');
        $output->expects($this->once())->method('isVerbose')->willReturn(true);
        $output->expects($this->once())->method('writeln')->with(" > <info>Fetching $expectedUrl</info>");

        $sut = new HttpFetch($client);
        $sut->attachConsoleOutput($output);

        $url = $sut->fetchUrl($expectedUrl);
    }
}