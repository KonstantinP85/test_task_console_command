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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        try {
            $this->newsManager->createNews();
        } catch (\Exception $e) {
            $io->error('Error: ' . $e->getMessage());
            return -1;
        }
        return 0;
    }
}