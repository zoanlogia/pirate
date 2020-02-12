<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/admin")
 * 
*/
class AdminController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index() {
        dump('OKqsqs');die;
        return $this->render('admin/base.html.twig', ['mainNavAdmin' => true, 'title' => 'Espace Admin']);
    }

}