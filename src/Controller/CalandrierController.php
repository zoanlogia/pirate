<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalandrierController extends AbstractController
{
    /**
     * @Route("/calandrier", name="calandrier")
     */
    public function index()
    {
        return $this->render('calandrier/index.html.twig', [
            'controller_name' => 'CalandrierController',
        ]);
    }
}
