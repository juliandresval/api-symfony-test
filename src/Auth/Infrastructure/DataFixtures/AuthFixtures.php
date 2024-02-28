<?php

namespace App\Auth\Infrastructure\DataFixtures;


use App\Auth\Infrastructure\Security\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuthFixtures extends Fixture
{

    function getData(): array
    {
        return [
            [
                'username' =>  'admin',
                'roles' => ["ROLE_ADMIN"],
                // Pa55w0rd
                'password' => '$2y$13$OnzZqmY/vShmhZ6bOQ91zuSIGVQQnesv.Cy.uilwhyzrxEFdg2fda'
            ],
        ];
    }

    public function load(ObjectManager $manager): void
    {

        foreach ($this->getData() as $key => $row) {
            $User = new User();
            $User->setUsername($row['username']);
            $User->setPassword($row['password']);
            $User->setRoles($row['roles']);
            $manager->persist($User);
        }

        $manager->flush();
    }
}
