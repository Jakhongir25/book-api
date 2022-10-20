<?php

declare(strict_types=1);

namespace App\Controller;

use App\Components\User\MaxAgeDto;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserGetMaxAgeAction extends AbstractController
{
    public function __invoke(UserRepository $userRepository): MaxAgeDto
    {
        return new MaxAgeDto($userRepository->findMaxAge());
    }
}