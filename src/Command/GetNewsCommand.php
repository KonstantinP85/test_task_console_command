<?php

declare(strict_types=1);

namespace App\Command;

use App\Manager\NewsManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetNewsCommand extends Command
{
    /**
     * @var NewsManager
     */
    private NewsManager $newsManager;

    /**
     * @param NewsManager $newsManager
     * @param string|null $name
     */
    public function __construct(NewsManager $newsManager, string $name = null)
    {
        parent::__construct($name);
        $this->newsManager = $newsManager;
    }

    protected function configure(): void
    {
        $this->setName('app:get-news');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->newsManager->createNews();
        } catch (\Exception $e) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}