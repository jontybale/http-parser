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
use JontyBale\HttpParser\Model\ProductList;
use JontyBale\HttpParser\Model\Url;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

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
    public function __construct(Client $client, OutputInterface $output = null)
    {
        $this->guzzle = $client;
        $this->attachConsoleOutput($output);
    }

    /**
     * Method to get an array of products from a remote URI.
     *
     * @param $uri string
     * @return ProductList
     */
    public function fetchProducts($uri)
    {
        // init our product list
        $products = new ProductList();

        // get main product URL
        $url = $this->fetchUrl($uri);

        // setup domcrawler
        $crawler = new Crawler($url->getResponseContents());
        $elements = $crawler->filter("#productLister div.productInfo h3 a");
        /** @var \DOMElement $element */
        foreach ($elements AS $element) {
            $products->addProduct(
                $this->getProductFromUrl(
                    $this->fetchUrl(
                        $element->getAttribute('href')
                    )
                )
            );
        }

        // and return!
        return $products;
    }

    /**
     * Method to parse the dom from a Url to create a Product.
     *
     * @param Url $url
     * @return Product
     */
    public function getProductFromUrl(Url $url)
    {
        // dom parse the information we need from the page
        $crawler = new Crawler($url->getResponseContents());

        // @todo review description data - it is a mess, crappy content?
        // are we after the meta description or value in the information tab?
        // going for information tab

        // and create the new product
        return new Product(
            $crawler->filter("div.productSummary h1")->text(),
            $crawler->filter("#information div.productText")->first()->text(),  // meh?
            $crawler->filter("p.pricePerUnit")->text(),
            $url
        );
    }

    /**
     * Method to get a Url object for a specific URI.
     *
     * @param $uri string
     * @return Url
     */
    public function fetchUrl($uri)
    {
        $request = new Request('GET', trim($uri));
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
    public function attachConsoleOutput(OutputInterface $output = null)
    {
        if (!is_null($output)) {
            $this->consoleOutput = $output;
        }
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