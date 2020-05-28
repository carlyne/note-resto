<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController {
	/** @Route("/restaurants", name="restaurants") */
	public function indexRestaurants()	: Response
	{
		return $this->render('restaurants/index.html.twig');
	}

	/** @Route("/restaurants/{id}", methods={"GET", "HEAD"}, requirements={"id"="\d+"}, name="restaurants_show") */
	public function showRestaurant(int $id) : Response
	{
		return $this->render('restaurants/show.html.twig');
	}


	/** @Route("/restaurants/{id}/edit", methods={"GET"}, requirements={"id"="\d+"}, name="restaurants_edit") */
	public function editRestaurant(int $id) : Response
	{
		return $this->render('restaurants/edit.html.twig');
	}

	/** @Route("/restaurants/{id}/update", methods={"GET", "POST"}, requirements={"id"="\d+"}, name="restaurants_update") */
	public function updateRestaurant(int $id, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}


	/** @Route("/restaurants/{id}/delete", name="restaurants_delete") */
	public function deleteRestaurants(int $id, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}


	/** @Route("/restaurants/new", name="restaurants_new") */
	public function newRestaurant() : Response
	{
		return $this->render('restaurants/new.html.twig');
	}

	/** @Route("/restaurants/create", methods={"GET", "POST"}, name="restaurants_create") */
	public function createRestaurants(Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}
}

?>