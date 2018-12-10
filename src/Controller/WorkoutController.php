<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\Workout;
use App\Form\WorkoutFormType;
use App\Repository\WorkoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/workout")
 */
class WorkoutController extends AbstractController
{
    /**
     * @Route("/index", name="app_workouts")
     */
    public function index(WorkoutRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $term = $request->query->get('search');

        $queryBuilder = $repository->findAllWithSearchQueryBuilder($term);

        $workouts = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1) /* page number */,
            10
        );

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

    /**
     * @Route("/new", name="app_workout_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(WorkoutFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var Workout $workout */
            $workout = $form->getData();
            $workout->setUser($this->getUser());
            $em->persist($workout);
            $em->flush();

            $this->addFlash('success', 'Workout Created!');

            return $this->redirectToRoute('app_workout_show', ['slug' => $workout->getSlug()]);
        }

        return $this->render('workout/new.html.twig', [
           'form'   =>  $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/update/{slug}", name="app_workout_update")
     */
    public function update(EntityManagerInterface $em, Request $request, Workout $workout)
    {
        $form = $this->createForm(WorkoutFormType::class, $workout);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var Workout $workout */
            $workout = $form->getData();
            $em->persist($workout);
            $em->flush();

            $this->addFlash('success', 'Workout Updated!');

            return $this->redirectToRoute('app_workout_show', ['slug' => $workout->getSlug()]);
        }

        return $this->render('workout/update.html.twig', [
            'form'      =>  $form->createView(),
            'workout'   =>  $workout,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/delete/{id}", name="app_workout_delete")
     */
    public function delete(EntityManagerInterface $em, Workout $workout)
    {
        $em->remove($workout);
        $em->flush();
        $this->addFlash('success', 'Workout Removed!');

        return $this->redirectToRoute("app_account");
    }


}
