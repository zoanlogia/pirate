<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PirateController extends AbstractController
{
    /**
     * @Route("/pirate", name="pirate")
     */
    public function index( \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('wf3sens2020@gmail/com')
            ->setTo('wf3sens2020@gmail.com')
            ->setBody('You should see me from the profiler!')
        ;
    
        $mailer->send($message);

        return $this->render('pirate/index.html.twig', [
            'controller_name' => 'PirateController',
        ]);
    }
}
