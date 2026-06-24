<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/events')]
#[IsGranted('ROLE_ADMIN')]
final class AdminEventController extends AbstractController
{
    #[Route('/', name: 'admin_event_index')]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('admin_event/index.html.twig', [
            'events' => $eventRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/{id}/publish', name: 'admin_event_publish')]
    public function publish(Event $event, EntityManagerInterface $entityManager): Response
    {
        $event->setStatus(Event::STATUS_PUBLISHED);
        $entityManager->flush();

        $this->addFlash('success', 'Événement publié.');

        return $this->redirectToRoute('admin_event_index');
    }

    #[Route('/{id}/reject', name: 'admin_event_reject')]
    public function reject(Event $event, EntityManagerInterface $entityManager): Response
    {
        $event->setStatus(Event::STATUS_REJECTED);
        $entityManager->flush();

        $this->addFlash('warning', 'Événement refusé.');

        return $this->redirectToRoute('admin_event_index');
    }
}