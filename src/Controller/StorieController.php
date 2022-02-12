<?php

namespace App\Controller;

use App\Entity\Storie;
use App\Form\StorieType;
use App\Repository\StorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/storie")
 */
class StorieController extends AbstractController
{
    /**
     * @Route("/", name="storie_index", methods={"GET"})
     */
    public function index(StorieRepository $storieRepository): Response
    {
        return $this->render('storie/index.html.twig', [
            'stories' => $storieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="storie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $storie = new Storie();
        $form = $this->createForm(StorieType::class, $storie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($storie);
            $entityManager->flush();

            return $this->redirectToRoute('storie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('storie/new.html.twig', [
            'storie' => $storie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="storie_show", methods={"GET"})
     */
    public function show(Storie $storie): Response
    {
        return $this->render('storie/show.html.twig', [
            'storie' => $storie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="storie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Storie $storie): Response
    {
        $form = $this->createForm(StorieType::class, $storie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('storie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('storie/edit.html.twig', [
            'storie' => $storie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="storie_delete", methods={"POST"})
     */
    public function delete(Request $request, Storie $storie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$storie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($storie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('storie_index', [], Response::HTTP_SEE_OTHER);
    }
}
