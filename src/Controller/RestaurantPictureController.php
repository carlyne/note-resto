<?php

namespace App\Controller;

use App\Entity\RestaurantPicture;
use App\Form\RestaurantPictureType;
use App\Repository\RestaurantPictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/restaurant/picture")
 */
class RestaurantPictureController extends AbstractController
{
    /**
     * @Route("/", name="restaurant_picture_index", methods={"GET"})
     */
    public function index(RestaurantPictureRepository $restaurantPictureRepository): Response
    {
        return $this->render('restaurant_picture/index.html.twig', [
            'restaurant_pictures' => $restaurantPictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="restaurant_picture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $restaurantPicture = new RestaurantPicture();
        $form = $this->createForm(RestaurantPictureType::class, $restaurantPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurantPicture);
            $entityManager->flush();

            return $this->redirectToRoute('restaurant_picture_index');
        }

        return $this->render('restaurant_picture/new.html.twig', [
            'restaurant_picture' => $restaurantPicture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restaurant_picture_show", methods={"GET"})
     */
    public function show(RestaurantPicture $restaurantPicture): Response
    {
        return $this->render('restaurant_picture/show.html.twig', [
            'restaurant_picture' => $restaurantPicture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="restaurant_picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RestaurantPicture $restaurantPicture): Response
    {
        $form = $this->createForm(RestaurantPictureType::class, $restaurantPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('restaurant_picture_index');
        }

        return $this->render('restaurant_picture/edit.html.twig', [
            'restaurant_picture' => $restaurantPicture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restaurant_picture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RestaurantPicture $restaurantPicture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurantPicture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($restaurantPicture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('restaurant_picture_index');
    }
}
