<?php

namespace Database\Factories;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProposalFactory extends Factory
{
    protected $model = Proposal::class;

    public function definition(): array
    {
        return [
            'collaboration_id' => $this->faker->randomNumber(),
            'influencer_id' => $this->faker->randomNumber(),
            'proposed_budget' => $this->faker->randomFloat(),
            'supporting_links' => $this->faker->word(),
            'supporting_files' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
