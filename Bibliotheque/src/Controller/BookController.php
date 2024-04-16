<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book; // Importe l'entité Book
use Doctrine\ORM\EntityManagerInterface;

class BookController extends AbstractController
{
    /**
     * @Route("/livres", name="liste_livres")
     */
    public function index(): Response
    {
        // Récupère le référentiel de l'entité Book
        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        
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
    public function show(int $id): Response
    {
        // Récupère le référentiel de l'entité Book
        $bookRepository = $this->getDoctrine()->getRepository(Book::class);
        
        // Récupère les détails du livre spécifié par son ID
        $livre = $bookRepository->find($id);
        
        // Vérifie si le livre existe
        if (!$livre) {
            throw $this->createNotFoundException('Livre non trouvé');
        }
        
        // Rend la vue Twig en passant les détails du livre
        return $this->render('livre/detail.html.twig', [
            'livre' => $livre,
        ]);
    }

    // Ajouter d'autres méthodes pour ajouter, modifier et supprimer des livres si nécessaire
}