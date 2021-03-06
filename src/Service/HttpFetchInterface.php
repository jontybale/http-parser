<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 11:25
 */

namespace JontyBale\HttpParser\Service;

use JontyBale\HttpParser\Model\Product;
use JontyBale\HttpParser\Model\Url;

/**
 * Interface HttpFetchInterface defining the HttpFetch service.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
interface HttpFetchInterface
{
    /**
     * Method to get an array of products from a remote URI.
     *
     * @param $uri string
     * @return Product[]
     */
    public function fetchProducts($uri);

    /**
     * Method to get a UriMeta object for a specific URI.
     *
     * @param $uri string
     * @return Url
     */
    public function fetchUrl($uri);
}