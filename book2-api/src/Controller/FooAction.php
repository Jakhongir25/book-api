<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooAction extends AbstractController
{
    public function __invoke(BookRepository $bookRepository)
    {
        $book = $bookRepository->find(4);

        $book = $bookRepository->findOneBy([
            'name' => '',
            'description' => ''
        ]);

        $book = $bookRepository->findBy(['name' => '']);
        $book = $bookRepository->findOneBySomeField('');
    }
}