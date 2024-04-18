<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function index(ReservationRepository $ReservationRepository): Response
    {
        $ReservationRepository = $ReservationRepository->findAll();

        return $this->render('reservation/index.html.twig', [
            'Reservation' =>  $ReservationRepository ,
        ]);
    }
}
