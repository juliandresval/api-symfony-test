<?php

namespace App\Auth\Domain\Entity;

/**
 * undocumented class
 */
interface UserInterface
{
    public function getId(): ?int;

    public function getUsername(): ?string;

    public function setUsername(string $username): static;

    public function getPassword(): string;

    public function setPassword(string $password): static;

    public static function create(array $values) : UserInterface;
}
