<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Entity\Book; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
   
    #[Route('/book', name: 'app_book')]
   
    public function index(BookRepository $bookRepository, Request $request ): Response
    {
        // Récupère le référentiel de l'entité Book
      
        
        // Récupère la liste des livres depuis la base de données
        $livres = $bookRepository->findAll();
        
        // Rend la vue Twig en passant les données des livres
        return $this->render('livre/index.html.twig', [
            'livres' => $livres,
        ]);
    }

    /**
     * @Route("/livres/{id}", name="detail_livre")
     */
    public function show(int $id, BookRepository $bookRepository ): Response
    {
        // Récupère le référentiel de l'entité Book
     
        
        // Récupère les détails du livre spécifié par son ID
        $livre = $bookRepository->find($id);
        
        // Vérifie si le livre existe
       // if (!$livre) {
        //    throw $this->createNotFoundException('Livre non trouvé');
    
        
        // Rend la vue Twig en passant les détails du livre
       return $this->render('livre/detail.html.twig', [
           'livre' => $livre,
       ]);
    }

    // Ajouter d'autres méthodes pour ajouter, modifier et supprimer des livres si nécessaire
}