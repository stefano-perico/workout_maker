<?php

namespace App\Controller;

use App\Entity\ExercisesList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exercise")
 */
class ExerciseController extends AbstractController
{
    /**
     * @Route("/index", name="exercise")
     */
    public function index()
    {
        return $this->render('exercise/index.html.twig');
    }

    /**
     * @Route("/show/{slug}", name="app_exercise_show")
     */
    public function show(ExercisesList $exercise)
    {
        return $this->render('exercise/show.html.twig', [
            'exercise'    =>  $exercise
        ]);
    }
}
