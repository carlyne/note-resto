<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController {
	/** @Route("/restaurants/{id}", requirements={"id"="\d+"}, name="restaurants_show") */
	public function indexAvis() : Response
	{
		return $this->render('restaurants/show.html.twig');
	}

	/** @Route("/restaurants/{idRestaurant}/avis/{$idAvis}", methods={"GET", "HEAD"}, requirements={"idRestaurant"="\d+", "idAvis"="\d+"}, name="restaurants_show_avis") */
	public function showAvis(int $idRestaurant, int $idAvis) : Response
	{
		return $this->render('restaurants/avis/show.html.twig');
	}


	/** @Route("/restaurants/{idRestaurant}/avis/{idAvis}/edit", methods={"GET"}, requirements={"idRestaurant"="\d+", "idAvis"="\d+"}, name="avis_edit") */
	public function editAvis(int $idRestaurant, int $idAvis) : Response
	{
		return $this->render('restaurant/avis/edit.html.twig');
	}

	/** @Route("/restaurants/{idRestaurant}/avis/{idAvis}/update", methods={"GET", "POST"}, requirements={"idRestaurant"="\d+", "idAvis"="\d+"}, name="avis_update") */
	public function updateAvis(int $idRestaurant, int $idAvis, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}


	/** @Route("/restaurants/{idRestaurant}/avis/{idAvis}/delete", requirements={"idRestaurant"="\d+", "idAvis"="\d+"}, name="avis_delete") */
	public function deleteAvis(int $idRestaurant, int $idAvis, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}


	/** @Route("restaurants/{id}/avis/new", requirements={"id"="\d+"}, name="avis_new") */
	public function newAvis(int $id) : Response
	{
		return $this->render('restaurants/avis/new.html.twig');
	}

	/** @Route("restaurants/{id}/avis/create", methods={"GET", "POST"}, requirements={"id"="\d+"}, name="avis_create") */
	public function createAvis(int $id, Request $request) : Response
	{
		$headerInfo = $request->query->get('q');
		dd($headerInfo);

		return $this->redirectToRoute('restaurants');
	}
}

?>