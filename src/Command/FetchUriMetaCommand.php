<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:16
 */

namespace JontyBale\HttpParser\Command;

use GuzzleHttp\Client;
use JontyBale\HttpParser\Service\HttpFetch;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FetchUriMetaCommand used for retrieving meta data about a URI.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class FetchUriMetaCommand extends FetchCommand
{
    protected function configure()
    {
        $this
            ->setName('http-parser:fetch:urimeta')
            ->setDescription('Fetch and retrieve information about a remote HTML page via HTTP.')
            ->addArgument(
                'uri',
                InputArgument::REQUIRED,
                'URI of the page which you want to get meta data for.'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // timeout should be much lower in production, high due to latency / bandwidth via ADSL.
        $httpFetch = new HttpFetch(new Client(['timeout' => 5]), $output);
        $url = $httpFetch->fetchUrl($this->validateInputUrl($input, $output));
        $output->write(json_encode($url));
    }
}