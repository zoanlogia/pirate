<?php

namespace App\Controller;

use App\Entity\Command;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    public function getPanier(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $panier = $session->get('panier', []);
        
        
        $panierProductInfo = [];
        $totalPrice = 0;
        $numCommand = rand(10000000, 1000000000);
        $erreurs = array();
        $autorise = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','à','â','ç','è','é','ê','î','ô','ù','û','ü','-', ' ');

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

        if (!empty($_POST)) {
            
            for($i = 0; $i < strlen($_POST['nom_card']); $i++)
            {
                if( in_array($_POST['nom_card'][$i], $autorise) == false )
                {
                    $erreurs[] = 'Il ya une erreur dans nom prenom';
                }
                if(!empty($erreurs)){
                    break ;
                }
            }

            if( strlen($_POST['num_card']) != 14 ){
                    $erreurs[] = "le numéro de la carte est mauvais";
            }
            if( strlen($_POST['code_card']) != 3 ){
                    $erreurs[] = "le code de la carte est mauvais";
            }
        
        }    

        
        if(empty($erreurs)){
            foreach( $panierProductInfo as $key => $value){
                            
                $command = new Command();
                $command->setTotalPrice($totalPrice)
                        ->setAdresse($_POST['adresse'])
                        ->setVille($_POST['ville'])
                        ->setCode($_POST['code'])
                        ->setPrenomUser($_POST['prenom_user'])
                        ->setNomUser($_POST['nom_user'])
                        ->setNumeroCommand($numCommand)
                        ->setQuantity($value['quantity'])
                        ->setPrix($value['produits']->getPrix())
                        ->setNom($value['produits']->getNom())
                        ->setProduitsId($value['produits']->getId())
                        ->setUser($user);
                        

                $em->persist($command);
                $em->flush();
            }
            
            $panier = $session->set('panier', []);

            return $this->render('paiement/index.html.twig', [
                'items' => $panierProductInfo,
                'totalPrice' => $totalPrice,
                
            ]);
        }
        else{
            foreach($erreurs as $message){
                $this->addFlash('error', "$message");
            }
            return $this->redirectToRoute('command');
        }

    }

}
