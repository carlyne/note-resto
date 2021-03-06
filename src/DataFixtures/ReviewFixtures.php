<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{

    private $restaurantRepository;
    private $reviewRepository;

    public function __construct(RestaurantRepository $restaurantRepository, ReviewRepository $reviewRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i<400; $i++) {
            $review = new Review();
            $review->setMessage( $faker->text(255) );
            $review->setRating( rand(0,5) );
            $review->setRestaurant( $this->restaurantRepository->find(rand(1, 100)) );
            $manager->persist($review);
        }

        $manager->flush();

        for ($i=0; $i<200; $i++) {
            $review = new Review();
            $review->setMessage( $faker->text(255) );
            $review->setRating( rand(0,5) );
            $review->setParent( $this->reviewRepository->find(rand(1, 400)) ); 
            $review->setRestaurant( $review->getParent()->getRestaurant() ); 
            $manager->persist($review);

        }

        $manager->flush();
    }
    

    public function getDependencies()
    {
        return array(RestaurantFixtures::class);
    }
}
