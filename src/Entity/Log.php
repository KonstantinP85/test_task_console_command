<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 * @ORM\Table(name="logs")
 */
class Log
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(name="request_time", type="datetime_immutable")
     */
    private \DateTimeImmutable $requestTime;

    /**
     * @var string
     * @ORM\Column(name="request_method", type="string")
     */
    private string $requestMethod;

    /**
     * @var string
     * @ORM\Column(name="request_url", type="string")
     */
    private string $requestUrl;

    /**
     * @var int
     * @ORM\Column(name="response_code", type="integer")
     */
    private int $responseCode;

    /**
     * @var string
     * @ORM\Column(name="response_body", type="text")
     */
    private string $responseBody;

    /**
     * @param $requestMethod
     * @param $requestUrl
     * @param $responseCode
     * @param $responseBody
     */
    public function __construct(
        $requestMethod,
        $requestUrl,
        $responseCode,
        $responseBody
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->requestTime = new \DateTimeImmutable();
        $this->requestMethod = $requestMethod;
        $this->requestUrl = $requestUrl;
        $this->responseCode = $responseCode;
        $this->responseBody = $responseBody;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRequestTime(): \DateTimeImmutable
    {
        return $this->requestTime;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestMethod
     */
    public function setRequestMethod(string $requestMethod): void
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @param string $requestUrl
     */
    public function setRequestUrl(string $requestUrl): void
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @param int $responseCode
     */
    public function setResponseCode(int $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    /**
     * @return string
     */
    public function getResponseBody(): string
    {
        return $this->responseBody;
    }

    /**
     * @param string $responseBody
     */
    public function setResponseBody(string $responseBody): void
    {
        $this->responseBody = $responseBody;
    }
}