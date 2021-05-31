<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $teams = [];

      // Groupe A
      array_push($teams, ['name' => 'Italie', 'groupe' => 1]);
      array_push($teams, ['name' => 'Suisse', 'groupe' => 1]);
      array_push($teams, ['name' => 'Turquie', 'groupe' => 1]);
      array_push($teams, ['name' => 'Pays de Galles', 'groupe' => 1]);

      // Groupe B
      array_push($teams, ['name' => 'Belgique', 'groupe' => 2]);
      array_push($teams, ['name' => 'Danemark', 'groupe' => 2]);
      array_push($teams, ['name' => 'Finlande', 'groupe' => 2]);
      array_push($teams, ['name' => 'Russie', 'groupe' => 2]);

      // Groupe C
      array_push($teams, ['name' => 'Autriche', 'groupe' => 3]);
      array_push($teams, ['name' => 'Pays-Bas', 'groupe' => 3]);
      array_push($teams, ['name' => 'Macédoine du Nord', 'groupe' => 3]);
      array_push($teams, ['name' => 'Ukraine', 'groupe' => 3]);

      // Groupe D
      array_push($teams, ['name' => 'Croatie', 'groupe' => 4]);
      array_push($teams, ['name' => 'République tchèque', 'groupe' => 4]);
      array_push($teams, ['name' => 'Angleterre', 'groupe' => 4]);
      array_push($teams, ['name' => 'Écosse', 'groupe' => 4]);

      // Groupe E
      array_push($teams, ['name' => 'Pologne', 'groupe' => 5]);
      array_push($teams, ['name' => 'Slovaquie', 'groupe' => 5]);
      array_push($teams, ['name' => 'Espagne', 'groupe' => 5]);
      array_push($teams, ['name' => 'Suède', 'groupe' => 5]);

      // Groupe F
      array_push($teams, ['name' => 'France', 'groupe' => 6]);
      array_push($teams, ['name' => 'Allemagne', 'groupe' => 6]);
      array_push($teams, ['name' => 'Hongrie', 'groupe' => 6]);
      array_push($teams, ['name' => 'Portugal', 'groupe' => 6]);

      foreach ($teams as $team) {
        $teamFixture = new Team();
        $teamFixture->setName($team['name']);
        $teamFixture->setGroupe($team['groupe']);
        $manager->persist($teamFixture);
      }

      $manager->flush();
    }
}
