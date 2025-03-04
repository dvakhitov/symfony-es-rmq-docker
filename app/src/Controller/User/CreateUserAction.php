<?php

namespace App\Controller\User;

use App\DTO\UserDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'create_user', methods: ['POST'], format: 'json')]
class CreateUserAction extends AbstractUserAction
{
    public function __invoke(
        #[MapRequestPayload]
        UserDto $userDto
    ): JsonResponse
    {
        try {
            $user = $this->userService->createUser($userDto->name, $userDto->email);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
            ],
            Response::HTTP_CREATED
        );
    }
}
