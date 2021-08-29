<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 * @ORM\Table(name="news")
 */
class News
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    private string $title;

    /**
     * @var string
     * @ORM\Column(name="link", type="string")
     */
    private string $link;

    /**
     * @var string
     * @ORM\Column(name="short_description", type="string", length=1000)
     */
    private string $shortDescription;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(name="publish_time", type="datetime_immutable")
     */
    private \DateTimeImmutable $publishTime;

    /**
     * @var string|null
     * @ORM\Column(name="author", type="string", nullable=true)
     */
    private ?string $author;

    /**
     * @var string|null
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private ?string $image;

    /**
     * @param string $title
     * @param string $link
     * @param string $shortDescription
     * @param \DateTimeImmutable $publishTime
     * @param string|null $author
     * @param string|null $image
     */
    public function __construct(
        string $title,
        string $link,
        string $shortDescription,
        \DateTimeImmutable $publishTime,
        ?string $author = null,
        ?string $image = null
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->link = $link;
        $this->shortDescription = $shortDescription;
        $this->publishTime = $publishTime;
        $this->author = $author;
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPublishTime(): \DateTimeImmutable
    {
        return $this->publishTime;
    }

    /**
     * @param \DateTimeImmutable $publishTime
     */
    public function setPublishTime(\DateTimeImmutable $publishTime): void
    {
        $this->publishTime = $publishTime;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}