<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:19
 */

namespace JontyBale\HttpParser\Service;

use JontyBale\HttpParser\Model\Product;
use JontyBale\HttpParser\Model\UriMeta;

/**
 * Class HttpFetch used as a facade on top of GuzzleHttp to fetch remote data and create
 * our domain models.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class HttpFetch implements HttpFetchInterface
{
    /**
     * Method to get an array of products from a remote URI.
     *
     * @param $uri string
     * @return Product[]
     */
    public function getProducts($uri)
    {
        // TODO: Implement getProducts() method.
    }

    /**
     * Method to get a UriMeta object for a specific URI.
     *
     * @param $uri string
     * @return UriMeta
     */
    public function getUriMeta($uri)
    {
        // TODO: Implement getUriMeta() method.
    }
}