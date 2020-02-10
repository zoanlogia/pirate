<?php

namespace App\DataFixtures;

use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $p1 = new Produits();
        $p1->setType("huiles essencielles")
           ->setNom("fruitée")
<<<<<<< HEAD
           ->setImage("{{ asset ('img/creme-1.jpeg')}}")
=======
           ->setImage("oil-5.jpeg")
>>>>>>> 53446962219251c4d09ffc2c3f9461c51b362e38
           ->setDescription("lorem...")
           ->setPrix(10);
        $manager->persist($p1);


        $p2 = new Produits();
        $p2->setType("huiles essencielles")
           ->setNom("bio")
           ->setImage("oil-6.jpeg")
           ->setDescription("lorem...")
           ->setPrix(10);
        $manager->persist($p2);


        $p3 = new Produits();
        $p3->setType("huiles essencielles")
           ->setNom("épicée")
           ->setImage("oil-3.jpeg")
           ->setDescription("lorem...")
           ->setPrix(10);
        $manager->persist($p3);


        $p4 = new Produits();
        $p4->setType("cosmétique")
           ->setNom("déodorants")
           ->setImage("deo-1.png")
           ->setDescription("lorem...")
           ->setPrix(9);
        $manager->persist($p4);

        $p5 = new Produits();
        $p5->setType("cosmétique")
           ->setNom("cheveux")
           ->setImage("shamp-1.jpeg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p5);


        $p6 = new Produits();
        $p6->setType("cosmétique")
           ->setNom("maquillage")
           ->setImage("oil-1.jpeg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p6);


        $p7 = new Produits();
        $p7->setType("soins du corps")
           ->setNom("crème de laits")
           ->setImage("creme-1.jpeg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p7);

        $p8 = new Produits();
        $p8->setType("soins du corps")
           ->setNom("baumes à lèvres")
           ->setImage("baume-1.jpg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p8);


        $p9 = new Produits();
        $p9->setType("soins du corps")
           ->setNom("huiles de massage")
           ->setImage("oil-massage-1.jpeg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p9);


        $p10 = new Produits();
        $p10->setType("Diffusion Arome")
           ->setNom("diffuseurs élextrique")
           ->setImage("diffuseur-electrique-1.jpeg.png")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p10);


        $p11 = new Produits();
        $p11->setType("Diffusion Arome")
           ->setNom("brumisateur")
           ->setImage("brum-1.jpg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p11);
        

        $p12 = new Produits();
        $p12->setType("Diffusion Arome")
           ->setNom("diffseurs a tiges")
           ->setImage("diff-1.jpg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p12);
        

        $p13 = new Produits();
        $p13->setType("coffrets")
           ->setNom("coffrets huile essentielles")
           ->setImage("coffret-oil-1.jpg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p13);

        $p14 = new Produits();
        $p14->setType("coffrets")
           ->setNom("coffrets beauté naturelle")
           ->setImage("coffret-beaute-1.jpg")
           ->setDescription("lorem...")
           ->setPrix(7);
        $manager->persist($p14);
        
        $manager->flush();


    }
}
