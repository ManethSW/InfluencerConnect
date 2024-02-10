<?php

namespace Database\Factories;

use App\Models\CollaborationTask;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CollaborationTaskFactory extends Factory
{
    protected $model = CollaborationTask::class;

    public function definition(): array
    {
        return [
            'collaboration_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
