<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\DataFixtures;

use App\Shared\Infrastructure\Doctrine\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

final class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $actor = new Actor();
            $actor->setName("{$faker->firstName()} {$faker->lastName()}");
            $actor->setIsActive($faker->boolean(80));
            $manager->persist($actor);
        }

        $manager->flush();
    }
}
