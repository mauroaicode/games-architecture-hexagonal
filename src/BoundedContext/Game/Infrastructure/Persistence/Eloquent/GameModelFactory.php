<?php

namespace Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameModelFactory extends Factory
{
    protected $model = GameModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->randomElement(
                [
                    'Bamboo Rush',
                    'Reels of Wealth',
                    'Dragon & Phoenix',
                    'Take the Bank',
                ]
            ),
            'description' => $this->faker->sentence,
            'url' => $this->faker->randomElement(
                [
                    'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=806&lang=es',
                    'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=795&lang=es',
                    'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=814&lang=es',
                    'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=813&lang=es'
                ]
            ),
            'pathImage' => $this->faker->randomElement(
                [
                    'https://winchiletragamonedas.com/public/images/games/bamboo_rush.jpeg',
                    'https://winchiletragamonedas.com/public/images/games/reels_of_wealth.jpeg',
                    'https://winchiletragamonedas.com/public/images/games/dragon_phoenix.jpeg',
                    'https://winchiletragamonedas.com/public/images/games/take_the_bank.jpeg'
                ]
            )
        ];
    }
}
