<?php

namespace Amaur\TwigExo\Classes;

use DateTime;

class Article {
    private ?int $id;
    private ?string $title;
    private ?string $content;
    private ?User $author;
    private ?DateTime $dateTime;

    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $content
     * @param User|null $author
     * @param DateTime|null $dateTime
     */
    public function __construct(int $id = null, string $title = null, string $content = null, User $author = null, DateTime $dateTime = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->dateTime = $dateTime;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): Article
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor(?User $author): Article
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime|null $dateTime
     */
    public function setDateTime(?DateTime $dateTime): Article
    {
        $this->dateTime = $dateTime;
        return $this;
    }
}