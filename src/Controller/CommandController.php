<?php

namespace App\Controller;


use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    /**
     * @Route("/command", name="command")
     */
    public function getPanier(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $panier = $session->get('panier', []);
        
        
        $panierProductInfo = [];
        $totalPrice = 0;
        

        foreach($panier as $id => $quantity){
            // Initialisation du tableau associatif
            $panierProductInfo[] = [
                // récupération des données des produits
                'produits' => $produitsRepository->find($id),
                'quantity' => $quantity
                
            ];

        }

            foreach($panierProductInfo as $item){


                // Récupere le prix du produits et on le multiplie par la quantité du panier
                if(!$item['produits']){
                    continue;
                }
                $totalItem = $item['produits']-> getPrix() * $item['quantity'];
                $totalPrice += $totalItem;
            }
            

        
        
        
        return $this->render('command/index.html.twig', [
            'items' => $panierProductInfo,
            'totalPrice' => $totalPrice,
            
        ]);
    }

    
}

