<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorkoutController extends AbstractController
{
    /**
     * @Route("/workout", name="workout")
     */
    public function index()
    {
        return $this->render('workout/index.html.twig', [
            'controller_name' => 'WorkoutController',
        ]);
    }
}
