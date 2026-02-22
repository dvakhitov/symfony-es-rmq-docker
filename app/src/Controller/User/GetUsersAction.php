<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'get_users', methods: ['GET'], format: 'json')]
class GetUsersAction extends AbstractUserAction
{
    public function __invoke(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        $data = array_map(
            fn($user) => [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ],
            $users
        );

        return $this->json($data);
    }
}
