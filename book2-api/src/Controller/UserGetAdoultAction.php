<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserGetAdoultAction extends AbstractController
{
    public function __invoke(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        $result = [];

        foreach ($users as $item) {
            $result[] = $item;
        }

        return $result;
    }
}