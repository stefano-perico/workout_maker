<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 19/09/18
 * Time: 18:48
 */

namespace App\Controller\Admin;


use App\Repository\WorkoutRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin")
 */
class AdminWorkoutController extends AbstractController
{
    /**
     * @Route("/workout", name="admin_workout_index")
     */
    public function index(WorkoutRepository $repository, Request $request, PaginatorInterface $paginator){
        $term = $request->query->get('search');
        $queryBuilder = $repository->findAllWithSearchQueryBuilder($term);

        $workouts = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1) /* page number */,
            10
        );

        return $this->render("admin/workout/index.html.twig", [
            'workouts'  => $workouts
        ]);
    }

}