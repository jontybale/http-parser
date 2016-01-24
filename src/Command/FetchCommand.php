<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:16
 */

namespace JontyBale\HttpParser\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Basic fetch command with some functionality to ensure we are DRY
 *
 * @author jontyb
 * @package JontyBale\HttpParser
 */
class FetchCommand extends Command
{
    /**
     * Method to check our input for a URI argument and ensure that it is a valid
     * URL.
     *
     * @param InputInterface $input
     */
    public function validateInputUrl(InputInterface $input)
    {
        if (false === filter_var($input->getArgument('uri'), FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL supplied.');
        }
    }
}