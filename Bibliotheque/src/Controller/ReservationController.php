<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\RoomRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function index(ReservationRepository $ReservationRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $events = $ReservationRepository->findAll();
        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'title'=>'Indisponible',
                'start' => $event->getDateDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                'backgroundColor' => 'red',
              

            ];

        }

        $data = json_encode($rdvs);

        return $this->render('reservation/index.html.twig', compact('data'));
       
    }

    #[Route('/save-event', name: 'save_event', methods: ['POST'])]
    public function saveEvent(Request $request, EntityManagerInterface $entityManager, Security $security, UsersRepository $userRepository, RoomRepository $room): Response
    { 
        $eventData = $request->request->get('event-data');
        $event = json_decode($eventData, true);
       
        
        $roomId = 1;
        $room = $room->find($roomId);
        $userId = 1;
        $user = $userRepository->find($userId);
        
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setRoom($room);
        $reservation->setDateDebut(new \DateTime($event['start']));
        $reservation->setDateFin(new \DateTime($event['end']));
        // Définissez d'autres propriétés de l'entité Reservation si nécessaire
    
        $entityManager->persist($reservation);
        $entityManager->flush();
    
        // rediriger ou renvoyer une réponse appropriée
        return $this->redirectToRoute('app_reservation',['id' => $reservation->getId()]);

    
}
}
