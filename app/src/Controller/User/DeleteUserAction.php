<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/users/{user}', name: 'delete_user', methods: ['DELETE'])]
class DeleteUserAction extends AbstractUserAction
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(['message' => 'User deleted'], Response::HTTP_OK);
    }
}
