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
        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');

        $command = new FetchCommand('test');
        $command->validateInputUrl($input, $output);
    }

    /**
     * Test that when inverbose mode we are logging correctly.
     */
    public function testValidateInputConsoleLoggingWhenVerbose()
    {
        $validUrl = 'http://monkey.com/do-you-like-tennis';

        $input = $this->getMock('Symfony\Component\Console\Input\InputInterface');
        $input->method('getArgument')->with('uri')->willReturn($validUrl);

        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');
        $output->expects($this->once())
               ->method('isVerbose')
               ->willReturn(true);
        $output->expects($this->once())
               ->method('writeln')
               ->with(" > <comment>Input URL: $validUrl</comment>");

        $command = new FetchCommand('test');
        $command->validateInputUrl($input, $output);

    }

}