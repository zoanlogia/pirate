<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
 /**
     * @Route("/inscription", name="inscription_")
     */
class InscriptionController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    public function usersList(){
        return $this->render("admin/users.html.twig", [
           
           ]);
    }
}
