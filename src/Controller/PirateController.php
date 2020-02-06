<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PirateController extends AbstractController
{
    /**
     * @Route("/pirate", name="pirate")
     */

     /**@Route ("/") */
    public function index()
    {
        return $this->render('pirate/index.html.twig', [
            'controller_name' => 'PirateController',
        ]);
    }


}
