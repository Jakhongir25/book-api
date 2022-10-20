<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserFullNameAction extends AbstractController
{
    public function __invoke(Request $request)
    {
        print_r($request->getContent());
        exit();
    }
}