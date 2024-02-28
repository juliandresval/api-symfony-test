<?php

namespace App\Auth\Domain\Entity;


abstract class AbstractUser implements UserInterface
{

    private ?int $id = null;

    private ?string $username = null;

    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public static function create(array $values) : UserInterface {
        $user = new UserInterface();
        $user->setUsername($values['username']);
        $user->setPassword($values['password']);
        return $user;
    }
}
