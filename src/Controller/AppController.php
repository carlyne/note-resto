<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"} ,name="home")
     */
    public function index()
    {
        $lastBestRating = $this->getDoctrine()->getRepository(Review::class)->findLastBestRating();
        $restaurantsToDisplay = [];

        foreach($lastBestRating as $bestrating) {
            $restaurantsToDisplay[] = $this->getDoctrine()->getRepository(Restaurant::class)->find($bestrating['restaurantId']);
        };

        return $this->render('app/index.html.twig', [
            'restaurants' => $restaurantsToDisplay
        ]);
    }
}
