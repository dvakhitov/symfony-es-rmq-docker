<?php

namespace App\Controller\User;

use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbstractUserAction extends AbstractController
{

    public function __construct(protected readonly UserServiceInterface $userService)
    {
    }
}
