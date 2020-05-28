<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController {
	/** @Route("/restaurants", name="restaurants") */
	public function indexRatings() : Response
	{
		return $this->render('restaurants/index.html.twig');
	}

	/** @Route("/restaurants/{id}", methods={"GET", "HEAD"}, requirements={"id"="\d+"}, name="restaurants_show") */
	public function showRating(int $id) : Response
	{
		return $this->render('restaurants/show.html.twig');
	}


	/** @Route("/rating/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="rating_edit") */
	public function editRating(int $id) : Response
	{
		return $this->render('rating/edit.html.twig');
	}

	/** @Route("/rating/{id}/update", methods={"GET", "POST"}, requirements={"id"="\d+"}, name="rating_update") */
	public function updateRating(int $id, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}


	/** @Route("/rating/{id}/delete", name="rating_delete") */
	public function deleteRating(int $id, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}


	/** @Route("/rating/new", name="restaurants_new") */
	public function newRating() : Response
	{
		return $this->render('rating/new.html.twig');
	}

	/** @Route("/rating/create", methods={"GET", "POST"}, name="rating_create") */
	public function createRating(Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}
}

?>