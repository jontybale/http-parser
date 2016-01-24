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
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FetchProductsCommand used for retrieving information about products via
 * HTTP.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class FetchProductsCommand extends FetchCommand
{
    /**
     * Setup command options and configuration settings.
     */
    protected function configure()
    {
        $this
            ->setName('http-parser:fetch:products')
            ->setDescription('Fetch and retrieve information about products via HTTP.')
            ->addArgument(
                'uri',
                InputArgument::REQUIRED,
                'URI of the page which you want to scrap for products.'
            )
        ;
    }

    /**
     * Execute the actual command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputUrl = $this->validateInputUrl($input);
        if ($output->isVerbose()) {
            $output->writeln(" > <comment>Input URL: $inputUrl</comment>");
        }

        // timeout should be much lower in production, high due to latency / bandwidth at home.
        $client = new Client(['timeout' => 5]);
        $httpFetch = new HttpFetch($client);
        $httpFetch->attachConsoleOutput($output);

        // and fetch our productList
        $productList = $httpFetch->fetchProducts($inputUrl);

    }

}