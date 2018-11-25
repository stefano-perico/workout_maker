<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image", name="image")
     */
    public function index(EntityManagerInterface $em, Request $request, ImageRepository $imageRepository)
    {
        $imageTest = $imageRepository->findAll();
        $imageForm = $this->createForm(ImageType::class);

        $imageForm->handleRequest($request);
        if ($imageForm->isSubmitted() && $imageForm->isValid()){
           /** @var Image $image */
            $image = $imageForm->getData();
            $em->persist($image);
            $em->flush();

            return new Response(dd($image->getBase64Encode()));
        }

        return $this->render('image/index.html.twig', [
            'imageForm' => $imageForm->createView(),
            'image' => $imageTest,
        ]);
    }
}
