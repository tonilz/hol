<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use App\Models\ReadingFactory;

class ParseReadingCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('parse-reading')
            ->addArgument('inputFile', InputArgument::REQUIRED, 'File to get the reading.')
            ->setDescription('Parses a reading to detect frauds.')
            ->setHelp("This commans allows you to parse a CSV or XML file with readings to get if there's any fraud.")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dataFile = $input->getArgument('inputFile');
        $output->writeln("\nTrying to read ".$input->getArgument('inputFile')."\n");

        $readings = ReadingFactory::create($dataFile);

        $frauds = $readings->getPossibleFrauds();

        if (count($frauds) === 0) {
            $output->writeln('CONGRATULATIONS! You got no frauds!');
        }

        else {
            $output->writeln("\nWARNING! Frauds detected!\n");
            $output->writeln("| Client              | Month              | Suspicious         | Median");
            $output->writeln(" -------------------------------------------------------------------------------");

            foreach ($frauds as $fraud) {
                $output->writeln("| {$fraud['reading']->getId()}          | {$fraud['reading']->getPeriod()}            | {$fraud['reading']->getClientReading()}\t| \t{$fraud['median']}");
            }

        }
    }
}