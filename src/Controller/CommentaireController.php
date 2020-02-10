<?php

namespace App\Controller;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index()

    {   $repository = $this->getDoctrine()->getRepository(Commentaire::class);
        $commentaire = $repository->findAll();
        return $this->render('commentaire/index.html.twig',[
           
        "commentaire" => $commentaire
            
        ]); 
        
    }
}
