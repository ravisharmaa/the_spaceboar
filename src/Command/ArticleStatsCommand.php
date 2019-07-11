<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Returns Article Stats')
            ->addArgument('slug', InputArgument::REQUIRED, 'Article slug')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'Option description','text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = [
          'slug' => $slug,
          'hearts' => rand(1, 100),
        ];

        switch ($input->getOption('format')) {
            case 'text':
                $rows = [];
                foreach ($data as $key => $val) {
                    $rows[] = [$key, $val];
                }
                $io->table(['KEY', 'VAL'], $rows);
                break;
            case 'json':
                $io->write(\GuzzleHttp\json_encode($data));
                break;
            default:
                throw new \Exception('WHoops');
        }
    }
}
