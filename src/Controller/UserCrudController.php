<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractController
{
    /**
     * @Route("/user/crud", name="user_crud")
     */
    public function index()
    {
        return $this->render('user_crud/index.html.twig', [
            'controller_name' => 'UserCrudController',
        ]);
    }
}
