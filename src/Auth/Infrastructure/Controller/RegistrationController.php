<?php

namespace App\Auth\Infrastructure\Controller;


use App\Auth\Application\UseCase\SaveUser;
use App\Auth\Infrastructure\Security\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{

    #[Route('/api/user_register', name: 'api_register', methods: 'POST', format: 'json')]
    public function post(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        SaveUser $saveUser,
    ): Response
    {
        if ($data = json_decode($request->getContent(), true)) {
            $user = User::create($data);
            $user->setPassword($userPasswordHasher->hashPassword($user, $data['password']));
            $result = $saveUser($user);
            $message = $result ? 'ok': 'error';
            $status = $result ? 200 : 500;
        } else {
            $status = 400;
            $message = 'error';
        }
        return $this->json(['data' => [], 'message' => $message], $status);
    }
}
