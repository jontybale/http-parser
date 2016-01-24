<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:50
 */

namespace JontyBale\HttpParser\Tests\Command;

use JontyBale\HttpParser\Command\FetchProductsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class FetchProductsCommandTest extends \PHPUnit_Framework_TestCase {

    /**
     * Test command execution with no URI, should throw.
     *
     * @expectedException        \Symfony\Component\Console\Exception\RuntimeException
     * @expectedExceptionMessage Not enough arguments (missing: "uri").
     */
    public function testExecuteWithNoUri()
    {
        $application = new Application();
        $application->add(new FetchProductsCommand());

        $command = $application->find('http-parser:fetch:products');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    }

}