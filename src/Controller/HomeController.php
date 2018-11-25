<?php

namespace App\Controller;

use App\Repository\WorkoutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function home(WorkoutRepository $workoutRepository)
    {
        $workouts = $workoutRepository->findThreeLastPublishedWorkouts();
        return $this->render('home/home.html.twig', [
            'workouts'  =>  $workouts,
        ]);
    }
}
