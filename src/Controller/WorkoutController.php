<?php

namespace App\Controller;

use App\Entity\Workout;
use App\Repository\WorkoutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/workout/")
 */
class WorkoutController extends AbstractController
{
    /**
     * @Route("/index", name="app_workouts")
     */
    public function index(WorkoutRepository $repository)
    {
        $workouts = $repository->findAllPublishedWorkoutByNewest();

        return $this->render('workout/index.html.twig', [
            'workouts'  =>  $workouts
        ]);
    }

    /**
     * @Route("/show/{slug}", name="app_workout_show")
     */
    public function show(Workout $workout)
    {
        return $this->render('workout/show.html.twig', [
           'workout'    =>  $workout
        ]);
    }
}
