<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    /**
     * @Route("/item", name="item")
     */
    public function item(): Response
    {
        return $this->render('home/item.html.twig', []);
    }

    /**
     * @Route("/cat/{slug}", name="cat")
     * @param String $slug 
     */
    public function cat(String $slug): Response
    {
        return $this->render('home/cat.html.twig', [
            'slug' => $slug
        ]);
    }
}
