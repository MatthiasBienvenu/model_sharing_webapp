<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Model;
use App\Entity\Vault;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach ($this->getVaultsData() as $vaultConfig) {
            $vault = new Vault();
            $manager->persist($vault);

            for ($i = 0; $i < $vaultConfig['models_count']; $i++) {
                $model = new Model();
                $model->setVault($vault);

                // Future-proof: unique fields if they exist
                $model->setName($faker->words(3, true)); // e.g. "neural predictor net"
                // $model->setDescription($faker->paragraph()); // unique text per model
                // $model->setCode($this->generateRandomTorchCode($faker)); TODO: implement generateRandomTorchCode
                $model->setPytorchCode($faker->text());

                $manager->persist($model);
            }
        }

        $manager->flush();
    }

    private function getVaultsData(): array
    {
        return [
            ['models_count' => 2],
            ['models_count' => 3],
            ['models_count' => 4]
        ];
    }
}
