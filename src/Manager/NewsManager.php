<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Log;
use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class NewsManager
{
    public const NEWS_URI = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createNews(): void
    {
        $client = new HttpClient();
        try {
            $response = $client->get(self::NEWS_URI);
            $content = $response->getBody()->getContents();
            $crawler = new Crawler($content);

            $log = new Log('GET', self::NEWS_URI, $response->getStatusCode(), $content);
            $this->entityManager->persist($log);
            $crawler->filter('item')->each(function (Crawler $node, $i) {
                $title = $node->filter('item > title')->text();
                $link = $node->filter('item > link')->text();
                $description = $node->filter('item > description')->text();
                $publishTime = (new \DateTimeImmutable)->setTimestamp(strtotime($node->filter('item > pubDate')->text()));

                if (count($node->filter('item > author')) !== 0) {
                    $author = $node->filter('item > author')->text(null);
                } else {
                    $author = null;
                }
                if (count($node->filter('item > enclosure')) !== 0) {
                    $image = $node->filter('item > enclosure')->attr('url');
                } else {
                    $image = null;
                }

                $news = new News($title, $link, $description, $publishTime, $author, $image);
                $this->entityManager->persist($news);
            });
            $this->entityManager->flush();

        } catch (GuzzleException $e) {
            $log = new Log('GET', self::NEWS_URI, $e->getCode(), $e->getMessage());
            $this->entityManager->persist($log);
            $this->entityManager->flush();
        }
    }
}