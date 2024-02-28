<?php

namespace App\Auth\Application\UseCase;

use App\Auth\Domain\Entity\AbstractUser;
use App\Auth\Domain\Entity\UserInterface;
use App\Auth\Domain\Repository\UserRepositoryInterface;

/**
 * undocumented class
 */
final class SaveUser
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(UserInterface $user): mixed
    {
        return $this->exec($user);
    }

    protected function exec(UserInterface $user): mixed
    {
        return $this->userRepository->save($user);
    }
}
