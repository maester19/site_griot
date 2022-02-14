<?php

namespace App\Controller;

use App\Entity\Storie;
use App\Repository\ChapitreRepository;
use App\Repository\StorieRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class HomeController extends AbstractController
{
    private $repository;
    /**
     * @var ObjectManager
     */
     public function __construct(StorieRepository $repository)
     {
        $this->repository = $repository;
     }

    /**
     * @Route("/", name="home")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $stories = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('home/index.html.twig', [
            'stories' => $stories
        ]);
    }

    /**
     * @Route("/item/{id}", name="item")
     * @param int $id
     */
    public function item(Storie $storie, PaginatorInterface $paginator, Request $request,
                ChapitreRepository $repository): Response
    {
        $chapitres = $paginator->paginate(
            $repository->findAllVisibleQuery($storie),
            $request->query->getInt('page',1),
            1
        );
        return $this->render('home/item.html.twig', [
            'chapitres' => $chapitres,
        ]);
    }

    /**
     * @Route("/cat/{slug}", name="cat")
     * @param String $slug 
     */
    public function cat(String $slug, StorieRepository $repositori): Response
    {
        $stories = $repositori->findAll();
        return $this->render('home/cat.html.twig', [
            'slug' => $slug,
            'stories' => $stories
        ]);
    }
}
