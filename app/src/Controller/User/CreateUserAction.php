<?php

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'create_user', methods: ['POST'])]
class CreateUserAction extends AbstractUserAction
{
    public function __invoke(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'], $data['email'])) {
            return new JsonResponse(
                ['error' => 'Missing parameters: name and email required'],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $user = $this->userService->createUser($data['name'], $data['email']);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            ['message' => 'User created', 'id' => $user->getId()],
            Response::HTTP_CREATED
        );
    }
}
