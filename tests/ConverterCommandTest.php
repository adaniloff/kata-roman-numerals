<?php

namespace App\Tests;

use App\Service\Converter;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class ConverterCommandTest extends KernelTestCase
{
    public function testCommandClass()
    {
        $this->assertTrue(class_exists('App\Command\ConverterCommand'));
    }

    public function testCommandName()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:converter');

        $this->assertNotNull($command);

        return $command;
    }

    /**
     * @depends testCommandName
     * @param $command
     */
    public function testCommandWithInvalidInput(Command $command)
    {
        $this->expectException(\TypeError::class);

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            'number' => 'test',
        ]);
    }

    /**
     * @depends testCommandName
     * @param $command
     */
    public function testCommandWithEmptyInput(Command $command)
    {
        $this->expectException(\TypeError::class);

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'number' => 'test',
        ]);
    }

    /**
     * @depends testCommandName
     * @param $command
     */
    public function testCommandWithValidInput(Command $command)
    {
        $number = 10;
        $romanNumeral = Converter::convert($number);
        
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'number' => $number,
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains("Your number is: $number and its roman numeral equivalence is: $romanNumeral", $output);
    }
}
