<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Storie;
use App\Entity\StorieSearch;
use App\Repository\AuteurRepository;
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
     * @Route("/", name="home", methods={"get", "post"})
     */
    public function index(PaginatorInterface $paginator, Request $request, AuteurRepository $repo): Response
    {
        
        $storieSearch = new StorieSearch();
        if($request->isMethod('POST')) {
            $data = $request->request->all();
            $storieSearch->setTitreStorie($data['titreStorie'])
                    ->setNomAuteur($data['nomAuteur']);
        }
        
        $stories = $paginator->paginate(
            $this->repository->findAllVisibleQuery($storieSearch),
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
            'chapters' => $repository->findAllVisible($storie)
        ]);
    }

    /**
     * @Route("/cat/{slug}", name="cat")
     * @param String $slug 
     */
    public function cat(String $slug, Request $request, PaginatorInterface $paginator): Response
    {
        $storieSearch = new StorieSearch();
        if($request->isMethod('POST')) {
            $data = $request->request->all();
            $storieSearch->setTitreStorie($data['titreStorie'])
                    ->setNomAuteur($data['nomAuteur']);
        }
        
        $stories = $paginator->paginate(
            $this->repository->findAllVisibleQuery($storieSearch),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('home/cat.html.twig', [
            'slug' => $slug,
            'stories' => $stories
        ]);
    }
}
