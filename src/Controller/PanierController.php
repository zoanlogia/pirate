<?php

namespace App\Controller;

// ajouter le use repository produit
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier_index")
     */
    public function index(SessionInterface $session)//, ProduitsRepository $produitsRepository)
    {
        // On récupere ce qu'il y a dans la session, dans le panier
        $panier = $session->get('panier', []);

        //Initialisation d'un array pour récuperer les informations des produits
        $panierProductInfo = [];

        foreach($panier as $id => $quantity){
            // Initialisation du tableau associatif
            $panierProductInfo[] = [
                // récupération des données des produits
                //'produits' => $produitsRepository->find($id),
                'quantity' => $quantity
            ];

            $totalPrice = 0;

            // Calcul du prix total du panier
            foreach($panierProductInfo as $item){

                // Récupere le prix du produits et on le multiplie par la quantité du panier
                $totalItem = $item['produits']-> getPrice() * $item['quantity'];
                $totalPrice += $totalItem;
            }
        }

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            // envoie les informations du panier au twig
            'items' => $panierProductInfo,
            // envoie du calcul du prix du panier au twig
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */

     // Fonction avec container de service pour ajouter des produits au panier
    public function addPanier($id, SessionInterface $session){

        $panier = $session->get('panier', []);

        // Si le panier n'est pas vide on incrémente, sinon on prend 1
        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id] = 1;
        }

        // On donne a la session le panier
        $session->set('panier', $panier);

        // redirection a l'index du panier (a voir si on enleve)
        // return $this->redirectToRoute("panier_index");
    }

    /**
     * @Route("panier/remove/{id}", name="panier_remove")
     */
    // Fonction pour supprimer un produits
    public function removeProduits($id, SessionInterface $session){
        // Récupere le panier
        $panier = $session->get('panier', []);

        // Si panier pas vide, on le supprime (unset)
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        // On donne a la session le nouveau panier
        $session->set('panier', $panier);

        // redirection a l'index du panier
        return $this->redirectToRoute("panier_index");
    }

    /**
     * @Route("panier/subtract/{id}", name="panier_subtract")
     */
    // Fonction pour enlever un produits
    public function subtractProduits($id, SessionInterface $session){
        // Récupere le panier
        $panier = $session->get('panier', []);

        // On enleve 1 de quantity si supérieur a 0
        if($panier[$id] > 0){
            $panier[$id]--;
            // si il ne reste plus de produits on le supprime
            if($panier[$id] == 0){
                unset($panier[$id]);
            }
        }

        // On donne a la session le nouveau panier
        $session->set('panier', $panier);

    }
}
