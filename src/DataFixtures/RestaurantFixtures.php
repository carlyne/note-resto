<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RestaurantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $restaurant = new Restaurant();
            $restaurant->setName($faker->company);
            $restaurant->setCreatedAt(new DateTime());
            $manager->persist($restaurant);
        }

        $manager->flush();
    }
}
