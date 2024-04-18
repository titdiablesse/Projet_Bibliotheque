<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(private BookRepository $bookRepository){

    }
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'livres' => $this->bookRepository->findAll(),
        ]);
    }
    #[Route('/detail/{id}', name: 'details')]
    public function details( Book $book): Response
    {
        // $categ = $this->categ->findOneById([
        //     'id' => $id
        // ]);
        return $this->render('livre/detail.html.twig', [
           
            'book' => $book
        ]);
    }
}
