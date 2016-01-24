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
        $url = $this->fetchUrl($uri);

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
        return new Url(
            $request,
            $this->guzzle->send($request, ['timeout' => 2])
        );
    }
}