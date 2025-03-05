<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService implements UserServiceInterface
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function getAllUsers(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function createUser(string $name, string $email): User
    {
        $existingUser = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existingUser) {
            throw new \InvalidArgumentException('User with this email already exists');
        }

        $user = new User();
        $user->setName($name)
            ->setEmail($email);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function deleteUser(int $id): void
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user) {
            throw new \InvalidArgumentException('User not found');
        }

        $this->em->remove($user);
        $this->em->flush();
    }
}
