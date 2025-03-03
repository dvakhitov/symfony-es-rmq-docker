<?php

namespace App\Service;

use App\Entity\User;

interface UserServiceInterface
{
    /**
     * @return User[]
     */
    public function getAllUsers(): array;

    /**
     * @throws \InvalidArgumentException если данные невалидны или email уже используется
     */
    public function createUser(string $name, string $email): User;

    public function deleteUser(int $id): void;
}
