<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:16
 */

namespace JontyBale\HttpParser\Command;

use Symfony\Component\Console\Command\Command;
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
class FetchProductsCommand extends Command
{
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        throw new \BadMethodCallException('Not implemented.');
    }
}