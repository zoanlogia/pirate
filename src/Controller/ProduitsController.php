<?php

namespace App\Controller;

use App\Entity\PostLike;
use App\Entity\Produits;
use App\Repository\PostLikeRepository;
use App\Repository\ProduitsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index(ProduitsRepository $repository)
    {   
        return $this->render('produits/index.html.twig', [
            'produit' => $repository->findAll()
        ]);
    }

    /**
     * Permet de liker ou unliker un article
     * 
     * @Route("/produits/{id}/like", name="produits_like")
     * 
     * @param \App\Entity\Produits $produits
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param \App\Repository\PostLikeRepository $postLikeRepository
     * @return \symfony\Component\HttpFoundation\Response 
     */

    public function like(Produits $produits,  PostLikeRepository $postLikeRepository ) : HttpFoundationResponse {
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if(!$user) return $this->json([
            'code' => 403,
            'message' => "Unauthorized"
        ], 403);

        if($produits->isLikedByUser($user)){
            $like = $postLikeRepository->findOneBy([
                'produits' => $produits,
                'user' => $user
            ]);
            
            $em->remove($like);
            $em->flush();

            return $this->json([
                'code' => 200,
                'message' => "Like bien supprimé",
                'likes' => $postLikeRepository->count(['produits' => $produits])
            ], 200);
        }

        $like = new PostLike();
        $like->setProduits($produits)
             ->setUser($user);

        $em->persist($like);
        $em->flush();

        return $this->json(['code' => 200, 'message' => 'Ca marche bien'], 200);    
    }
}
