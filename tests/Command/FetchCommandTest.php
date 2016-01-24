<?php
/**
 * Created by PhpStorm.
 * User: jontyb
 * Date: 24/01/16
 * Time: 10:50
 */

namespace JontyBale\HttpParser\Tests\Command;

use JontyBale\HttpParser\Command\FetchCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Tester\CommandTester;

class FetchCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Method to validate input is a valid url - testing failuire.
     *
     * @expectedException \Symfony\Component\Console\Exception\InvalidArgumentException
     * @expectedExceptionMessage Invalid URL supplied.
     */
    public function testValidateInputUrlFailure()
    {
        $invalidUrl = 'http//monkey.com/do-you-like-tennis';
        $input = $this->getMock('Symfony\Component\Console\Input\InputInterface');
        $input->method('getArgument')->with('uri')->willReturn($invalidUrl);

        $command = new FetchCommand('test');
        $command->validateInputUrl($input);
    }

}