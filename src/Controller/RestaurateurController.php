<?php

namespace App\Controller;

use App\Entity\Restaurateur;
use App\Form\RestaurateurType;
use App\Repository\RestaurateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/restaurateur")
 */
class RestaurateurController extends AbstractController
{
    /**
     * @Route("/", name="restaurateur_index", methods={"GET"})
     */
    public function index(RestaurateurRepository $restaurateurRepository): Response
    {
        return $this->render('restaurateur/index.html.twig', [
            'restaurateurs' => $restaurateurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="restaurateur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $restaurateur = new Restaurateur();
        $form = $this->createForm(RestaurateurType::class, $restaurateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurateur);
            $entityManager->flush();

            return $this->redirectToRoute('restaurateur_index');
        }

        return $this->render('restaurateur/new.html.twig', [
            'restaurateur' => $restaurateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restaurateur_show", methods={"GET"})
     */
    public function show(Restaurateur $restaurateur): Response
    {
        return $this->render('restaurateur/show.html.twig', [
            'restaurateur' => $restaurateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="restaurateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Restaurateur $restaurateur): Response
    {
        $form = $this->createForm(RestaurateurType::class, $restaurateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('restaurateur_index');
        }

        return $this->render('restaurateur/edit.html.twig', [
            'restaurateur' => $restaurateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restaurateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Restaurateur $restaurateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($restaurateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('restaurateur_index');
    }
}
