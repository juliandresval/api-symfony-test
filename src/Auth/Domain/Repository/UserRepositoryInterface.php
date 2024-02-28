<?php

namespace App\Auth\Domain\Repository;

use App\Auth\Domain\Entity\AbstractUser;

interface UserRepositoryInterface
{

    public function save(AbstractUser $user): bool;
}
