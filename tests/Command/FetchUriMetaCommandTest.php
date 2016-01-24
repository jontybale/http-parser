<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:50
 */

namespace JontyBale\HttpParser\Tests\Command;

use JontyBale\HttpParser\Command\FetchUriMetaCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class FetchUriMetaCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test command execution with no URI, should throw.
     *
     * @expectedException        \Symfony\Component\Console\Exception\RuntimeException
     * @expectedExceptionMessage Not enough arguments (missing: "uri").
     */
    public function testExecuteWithNoUri()
    {
        $application = new Application();
        $application->add(new FetchUriMetaCommand());

        $command = $application->find('http-parser:fetch:urimeta');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    }

    /**
     * Ensure bad argument is thrown when supplied with an invalid url.
     *
     * @expectedException \Symfony\Component\Console\Exception\InvalidArgumentException
     * @expectedExceptionMessage Invalid URL supplied.
     */
    public function testExecuteWithInvalidUri()
    {
        $invalidUrl = 'http//monkey.com/do-you-like-tennis';

        $application = new Application();
        $application->add(new FetchUriMetaCommand());

        $command = $application->find('http-parser:fetch:urimeta');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                'command' => $command->getName(),
                'uri'     => $invalidUrl
            )
        );
    }

}