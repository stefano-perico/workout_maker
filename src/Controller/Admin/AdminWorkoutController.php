<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 19/09/18
 * Time: 18:48
 */

namespace App\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin/")
 */
class AdminWorkoutController extends AbstractController
{
    /**
     * @Route("/workout/new", name="app_workout_new")
     */
    public function new(){
        return "test";
    }

}