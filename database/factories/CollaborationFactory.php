<?php

namespace Database\Factories;

use App\Models\Collaboration;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaborationFactory extends Factory
{
    protected $model = Collaboration::class;

    public function definition(): array
    {
        return [
            'business_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),
            'collaboration_type' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'budget' => $this->faker->randomFloat(),
            'deadline' => $this->faker->dateTime(),
            'status' => $this->faker->randomNumber(),
        ];
    }
}
