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
 * Class FetchUriMetaCommand used for retrieving meta data about a URI.
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class FetchUriMetaCommand extends Command
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
        throw new \BadMethodCallException('Not implemented.');
    }
}