<?php

namespace App\Controller;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Intl\Scripts;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchbarController extends AbstractController
{
    /**
    * @Route ("/Search", name="Search", methods={"GET","POST"})
     */
public function search(Request $request)
    {
        
            return $this->render('searchbar/index.html.twig');
        }
    }
