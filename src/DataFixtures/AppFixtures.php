<?php

namespace App\DataFixtures;

use App\Entity\Showcase;
use App\Repository\VaultRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Model;
use App\Entity\Vault;
use App\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\ManagerConfigurator;
use RuntimeException;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach ($this->getMembersData() as $config) {
            $member = new Member();
            $vault = new Vault();
            $email = $faker->email;
            $password = $faker->password();

            print("user: $email, password: $password\n");
            $member
                ->setEmail($email)
                ->setPassword(
                    $this->hasher->hashPassword($member, $password),
                )
                ->setVault($vault);

            for ($i = 0; $i < $config["models_count"]; $i++) {
                $model = new Model();
                $modelName = $faker->words(3, true);

                $model
                    ->setVault($vault)
                    ->setName($modelName)
                    ->setDescription($faker->text())
                    ->setPytorchCode($this->generateRealisticPytorchCode($modelName))
                    ->setImagePath($this->downloadRandomNeuralNetworkImage($i));

                $vault->addModel($model);
                $manager->persist($model);
            }

            $manager->persist($member);
            $manager->persist($vault);
            $manager->flush();

            $models = $vault->getModels()->toArray();

            foreach ($config["showcases_model_count"] as $model_count) {
                $showcase = new Showcase();

                $showcase
                    ->setDescription($faker->text())
                    ->setPublished($faker->boolean())
                    ->setMember($member);

                shuffle($models);

                for ($i = 0; $i < $model_count; $i++) {
                    $showcase->addModel($models[$i]);
                }

                $manager->persist($showcase);
            }



            $manager->flush();
        }

                // Manually add an admin with stupid login

        $adminVault = new Vault();
        $adminMember = new Member();

        $adminMember
            ->setEmail('admin@admin.com')
            ->setPassword($this->hasher->hashPassword($adminMember, 'admin'))
            ->setRoles(['ROLE_ADMIN', 'ROLE_USER'])
            ->setVault($adminVault);

        echo "Admin User: admin@admin.com, Password: admin\n";

        $manager->persist($adminMember);
        $manager->persist($adminVault);

        $manager->flush();
    }

    private function generateRealisticPytorchCode(string $modelName): string
    {
        $architectures = ['CNN', 'RNN', 'ResNet', 'VGG', 'DenseNet'];
        $architecture = $architectures[array_rand($architectures)];
        $numLayers = rand(3, 8);
        $hiddenSize = rand(64, 512);

        $layers = "";
        $forwardCode = "x = x.view(x.size(0), -1)\n";

        match($architecture) {
            'CNN' => $layers = $this->generateCNNLayers($numLayers),
            'RNN' => $layers = $this->generateRNNLayers($numLayers),
            'ResNet' => $layers = $this->generateResNetLayers($numLayers),
            'VGG' => $layers = $this->generateVGGLayers($numLayers),
            'DenseNet' => $layers = $this->generateDenseNetLayers($numLayers),
        };

        $code = <<<CODE
import torch
import torch.nn as nn
import torch.optim as optim

class NeuralNetwork(nn.Module):
    def __init__(self, input_size=784, num_classes=10):
        super(NeuralNetwork, self).__init__()

        $layers

        self.fc_out = nn.Linear($hiddenSize, num_classes)
        self.softmax = nn.Softmax(dim=1)

    def forward(self, x):
        x = x.view(x.size(0), -1)
        x = self.fc_out(x)
        x = self.softmax(x)
        return x

# Initialize model
model = NeuralNetwork()
criterion = nn.CrossEntropyLoss()
optimizer = optim.Adam(model.parameters(), lr=0.001)

# Training loop
for epoch in range(10):
    outputs = model(inputs)
    loss = criterion(outputs, labels)
    optimizer.zero_grad()
    loss.backward()
    optimizer.step()
CODE;

        return $code;
    }

    private function generateCNNLayers(int $numLayers): string
    {
        $layers = "";
        $inChannels = 1;
        $outChannels = 16;

        for ($i = 0; $i < $numLayers; $i++) {
            $layers .= "        self.conv$i = nn.Conv2d($inChannels, $outChannels, kernel_size=3, padding=1)\n";
            $layers .= "        self.relu$i = nn.ReLU()\n";
            if ($i % 2 == 0) {
                $layers .= "        self.pool$i = nn.MaxPool2d(kernel_size=2)\n";
            }
            $inChannels = $outChannels;
            $outChannels = min($outChannels * 2, 512);
        }

        return $layers;
    }

    private function generateRNNLayers(int $numLayers): string
    {
        $hiddenSize = rand(64, 256);
        $layers = "        self.rnn = nn.LSTM(input_size=784, hidden_size=$hiddenSize, num_layers=$numLayers, batch_first=True)\n";
        $layers .= "        self.fc1 = nn.Linear($hiddenSize, 128)\n";
        $layers .= "        self.relu = nn.ReLU()\n";

        return $layers;
    }

    private function generateResNetLayers(int $numLayers): string
    {
        $layers = "        self.conv1 = nn.Conv2d(1, 64, kernel_size=7, stride=2, padding=3)\n";
        $layers .= "        self.bn1 = nn.BatchNorm2d(64)\n";
        $layers .= "        self.relu = nn.ReLU(inplace=True)\n";

        for ($i = 0; $i < $numLayers; $i++) {
            $layers .= "        # ResNet block $i\n";
            $layers .= "        self.res_block_$i = nn.Sequential(\n";
            $layers .= "            nn.Conv2d(64, 64, kernel_size=3, padding=1),\n";
            $layers .= "            nn.BatchNorm2d(64),\n";
            $layers .= "            nn.ReLU(inplace=True),\n";
            $layers .= "            nn.Conv2d(64, 64, kernel_size=3, padding=1),\n";
            $layers .= "            nn.BatchNorm2d(64)\n";
            $layers .= "        )\n";
        }

        $layers .= "        self.avgpool = nn.AdaptiveAvgPool2d((1, 1))\n";
        $layers .= "        self.fc1 = nn.Linear(64, 128)\n";

        return $layers;
    }

    private function generateVGGLayers(int $numLayers): string
    {
        $layers = "";
        $inChannels = 1;
        $outChannels = 64;

        for ($i = 0; $i < $numLayers; $i++) {
            $layers .= "        self.vgg_conv$i = nn.Conv2d($inChannels, $outChannels, kernel_size=3, padding=1)\n";
            $layers .= "        self.bn$i = nn.BatchNorm2d($outChannels)\n";
            $layers .= "        self.relu$i = nn.ReLU(inplace=True)\n";
            if ($i % 2 == 1) {
                $layers .= "        self.pool$i = nn.MaxPool2d(kernel_size=2, stride=2)\n";
                $outChannels = min($outChannels * 2, 512);
            }
            $inChannels = $outChannels;
        }

        $layers .= "        self.fc1 = nn.Linear($outChannels, 256)\n";

        return $layers;
    }

    private function generateDenseNetLayers(int $numLayers): string
    {
        $layers = "        self.dense_block_1 = nn.Sequential(\n";

        for ($i = 0; $i < $numLayers; $i++) {
            $layers .= "            nn.Linear(784, 512) if $i == 0 else nn.Linear(512, 512),\n";
            $layers .= "            nn.BatchNorm1d(512),\n";
            $layers .= "            nn.ReLU(),\n";
        }

        $layers .= "        )\n";
        $layers .= "        self.fc1 = nn.Linear(512, 256)\n";

        return $layers;
    }

    private function downloadRandomNeuralNetworkImage(int $index): string
    {
        $imageUrl = "https://picsum.photos/400/300?random=$index";
        $imageName = "model_image_$index.jpg";
        $imagePath = "public/uploads/models/$imageName";

        @mkdir("public/uploads/models", 0755, true);

        $imageContent = @file_get_contents($imageUrl);
        if ($imageContent !== false && strlen($imageContent) > 0) {
            file_put_contents($imagePath, $imageContent);
            return "uploads/models/$imageName";
        }
        else {
            throw new RuntimeException("Failed to download image for model $index");
        }
    }

    private function getMembersData(): array
    {
        return [
            [
                "models_count" => 2,
                "showcases_model_count" => [],
            ],
            [
                "models_count" => 3,
                "showcases_model_count" => [2],
            ],
            [
                "models_count" => 10,
                "showcases_model_count" => [2, 5, 1],
            ],
        ];
    }
}