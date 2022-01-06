<?php

namespace Amaur\TwigExo\Classes;

class User {
    private ?int $id;
    private ?string $username;
    private ?string $password;
    private ?string $mail;

    /**
     * @param int|null $id
     * @param string|null $username
     * @param string|null $password
     * @param string|null $mail
     */
    public function __construct(int $id = null, string $username = null, string $password = null, string $mail = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->mail = $mail;
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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string|null $mail
     */
    public function setMail(?string $mail): User
    {
        $this->mail = $mail;
        return $this;
    }
}