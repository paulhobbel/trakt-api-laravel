<?php
/**
 * Created by PhpStorm.
 * User: Dizzy
 * Date: 15-7-2016
 * Time: 20:15
 */

namespace Dizzy\Trakt\Console;


use Dizzy\Trakt\Console\Generators\EndpointGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TraktGenerateCommand extends Command
{
    public function configure()
    {
        $this->setName("endpoint:generate")
            ->setDescription("Generates the wrapper classes from source")
            ->addArgument(
                "endpoint",
                InputArgument::OPTIONAL,
                "The endpoint you want to generate the wrapper for."
            )
            ->addOption(
                "force",
                "-f",
                InputOption::VALUE_NONE,
                "Forces the generator to continue even if there are errors."
            )
            ->addOption(
                "delete",
                "-d",
                InputOption::VALUE_NONE,
                "Deletes all files and folders before generating the wrappers."
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = new EndpointGenerator($input, $output, new QuestionHelper(), $input->getOption("force"), $input->getOption("delete"));

        if ($endpoint = $input->getArgument('endpoint')) {
            $output->writeln("Generating endpoint wrapper for: " . $endpoint);
            $generator->generateForEndpoint($endpoint);
            return true;
        }
        $generator->generateAllEndpoints();
        return true;
    }
}