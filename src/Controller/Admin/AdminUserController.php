<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 28/09/18
 * Time: 17:58
 */

namespace App\Controller\Admin;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 * @Route("/admin/")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("users/index", name="app_admin_user_index")
     */
    public function index(UserRepository $repository){
        $users = $repository->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("show/{id}", name="app_admin_user_show")
     */
    public function show(User $user)
    {
        return $this->render('admin/user/show.html.twig', [
            'user'    =>  $user
        ]);
    }

}