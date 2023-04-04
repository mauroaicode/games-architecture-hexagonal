<?php

namespace Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameModelFactory extends Factory
{
    protected $model = GameModel::class;
    //Nos permite crear datos de prueba
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'description' => $this->faker->sentence,
        ];
    }
}
