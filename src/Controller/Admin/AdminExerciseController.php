<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 01/12/18
 * Time: 19:11
 */

namespace App\Controller\Admin;


use App\Entity\ExercisesList;
use App\Form\ExercisesListFormType;
use App\Repository\ExerciseRepository;
use App\Repository\ExercisesListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin")
 */
class AdminExerciseController extends AbstractController
{
    /**
     * @Route("/exercise", name="admin_exercise_index")
     */
    public function index(ExercisesListRepository $exerciseRepository, Request $request, PaginatorInterface $paginator){
        $term = $request->query->get('search');
        $queryBuilder = $exerciseRepository->findAllExerciseByNewestWithSearchQueryBuilder($term);

        $exercises = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1) /* page number */,
            10
        );

        return $this->render('admin/exercise/index.html.twig', [
            'exercises'  => $exercises
        ]);
    }

    /**
     * @Route("/create", name="admin_exercise_create")
     */
    public function create(EntityManagerInterface $em, Request $request){
        $exerciseForm = $this->createForm(ExercisesListFormType::class);

        $exerciseForm->handleRequest($request);
        if ($exerciseForm->isSubmitted() && $exerciseForm->isValid()){
            /** @var ExercisesList $exercise */
            $exercise = $exerciseForm->getData();

            $em->persist($exercise);
            $em->flush();

            $this->addFlash('success', 'Exercise Created!');

            return $this->redirectToRoute('admin_exercise_index');
        }

        return $this->render('admin/exercise/create.html.twig', [
            'exerciseForm'  =>  $exerciseForm->createView(),
        ]);
    }

}