<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:19
 */

namespace JontyBale\HttpParser\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use JontyBale\HttpParser\Model\Product;
use JontyBale\HttpParser\Model\Url;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HttpFetch used as a facade on top of GuzzleHttp to fetch remote data and create
 * our domain models.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class HttpFetch implements HttpFetchInterface
{
    /** @var Client */
    private $guzzle;

    /** @var OutputInterface  */
    private $consoleOutput = null;

    /**
     * Setup fetcher.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->guzzle = $client;
    }

    /**
     * Method to get an array of products from a remote URI.
     *
     * @param $uri string
     * @return Product[]
     */
    public function fetchProducts($uri)
    {
        // get main product URL
        $url = $this->fetchUrl($uri);

        // dom parse to get our product list

        // fetchUrl for each product


        // return product list

        // TODO: Implement fetchProducts() method.
    }

    /**
     * Method to get a Url object for a specific URI.
     *
     * @param $uri string
     * @return Url
     */
    public function fetchUrl($uri)
    {
        $request = new Request('GET', $uri);
        $this->log("Fetching " . $uri);
        return new Url(
            $request,
            $this->guzzle->send($request)
        );
    }

    /**
     * Method to inject an output interface if being called by the console.
     *
     * @param OutputInterface $output
     */
    public function attachConsoleOutput(OutputInterface $output)
    {
        $this->consoleOutput = $output;
    }

    /**
     * Internal class log abstraction.
     *
     * @param $message
     */
    private function log($message)
    {
        if (!is_null($this->consoleOutput) && $this->consoleOutput->isVerbose()) {
            $this->consoleOutput->writeln(" > <info>" . $message . "</info>");
        }
    }
}