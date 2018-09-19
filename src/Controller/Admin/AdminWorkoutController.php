<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 19/09/18
 * Time: 18:48
 */

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminWorkoutController extends AbstractController
{
    /**
     * @Route("/admin/workout/new", name="app_workout_new")
     */
    public function new(){

    }

}