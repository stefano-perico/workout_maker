<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\WorkoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function home(WorkoutRepository $workoutRepository, Request $request, EntityManagerInterface $em)
    {
        $workouts = $workoutRepository->findThreeLastPublishedWorkouts();

        $contactForm = $this->createForm(ContactFormType::class);
        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            /** @var Contact $contact */
            $contact = $contactForm->getData();

            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', 'Your message has been sent!');
        }

        return $this->render('home/home.html.twig', [
            'workouts'  =>  $workouts,
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
