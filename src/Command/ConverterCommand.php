<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ConverterCommand extends Command
{
    protected static $defaultName = 'app:converter';

    protected function configure()
    {
        $this
            ->setDescription('Take a number as an input and convert it into a roman number')
            ->addArgument('number', InputArgument::REQUIRED, 'Number to convert')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $number = $input->getArgument('number');

        if ($number) {
            $io->note(sprintf('You passed an argument: %s', $number));
        }

        if (!is_int($number)) {
            throw new \InvalidArgumentException('Invalid argument: $number must be an int');
        }

        $io->success("Your number is: " . $number);
    }
}
