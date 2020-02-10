<?php

namespace App\Controller;

use App\Entity\Command;
use App\Repository\CommandRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    /**
     * @Route("/command", name="command")
     */
    public function getPanier(SessionInterface $session, ProduitsRepository $produitsRepository, CommandRepository $commandRepository)
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
            

        

        foreach( $panierProductInfo as $key => $value){
            dump( $value['produits']->getId());
            dump( $value['quantity'] );

            $command = new Command();
            $command->setQuantity($value['quantity'])
                    ->setPrix($value['produits']->getPrix())
                    ->setNom($value['produits']->getNom())
                    ->setProduitsId($value['produits']->getId())
                    ->setUser($user);
                    

            $em->persist($command);
            $em->flush();
        }
        $panier = $session->set('panier', []);
        
        return $this->render('command/index.html.twig', [
            'command' => $commandRepository->findAll(),
            'totalPrice' => $totalPrice,
            
        ]);
    }

  

    public function load(){

    }

    /**
     * @Route("/command/kill", name="command_kill")
     */
    public function killSession(SessionInterface $session){
        $panier = $session->get('panier', []);
        session_destroy($panier);
    }
    
}

