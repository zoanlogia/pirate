<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SendController extends AbstractController
{
    /**
     * @Route("/send", name="send")
     */
    public function index(\Swift_Mailer $mailer)
    {
        
                  
        $email = $_POST['email'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $commentaire = $_POST['commentaire'];
     
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom($email)
            ->setTo('wf3sens2020@gmail.com')
            ->setBody($commentaire)
        ;
    
        $send = $mailer->send($message);

        if($send){
            $this->addFlash('success', 'Votre message a bien été envoyé');
        } else{
            $this->addFlash('error', 'Veuillez completer tout les champs');
        }


        return $this->render('send/index.html.twig', [
            'controller_name' => 'SendController',
        ]);
    }
    
}