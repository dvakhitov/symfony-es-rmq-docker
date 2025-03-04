<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDto
{
    #[Assert\NotBlank(message: 'Name should not be blank')]
    #[Assert\Length(max: 255)]
    public string $name;

    #[Assert\NotBlank(message: 'Email should not be blank')]
    #[Assert\Email(message: 'Email is not valid')]
    public string $email;
}
