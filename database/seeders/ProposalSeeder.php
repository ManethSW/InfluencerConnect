<?php

namespace Database\Seeders;

use App\Models\Proposal;
use Illuminate\Database\Seeder;

class ProposalSeeder extends Seeder
{
    public function run(): void
    {
        Proposal::create([
            'collaboration_id' => 1,
            'influencer_id' => 2,
            'proposed_budget' => 14000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2, https://example.com/link3',
        ]);

        Proposal::create([
            'collaboration_id' => 2,
            'influencer_id' => 3,
            'proposed_budget' => 9000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2',
        ]);

        Proposal::create([
            'collaboration_id' => 3,
            'influencer_id' => 4,
            'proposed_budget' => 45000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2, https://example.com/link3',
        ]);

        Proposal::create([
            'collaboration_id' => 4,
            'influencer_id' => 5,
            'proposed_budget' => 9000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2',

        ]);

        Proposal::create([
            'collaboration_id' => 5,
            'influencer_id' => 6,
            'proposed_budget' => 45000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2, https://example.com/link3',

        ]);

        Proposal::create([
            'collaboration_id' => 6,
            'influencer_id' => 1,
            'proposed_budget' => 14000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2',

        ]);

        Proposal::create([
            'collaboration_id' => 7,
            'influencer_id' => 1,
            'proposed_budget' => 9000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2, https://example.com/link3',

        ]);

        Proposal::create([
            'collaboration_id' => 2,
            'influencer_id' => 2,
            'proposed_budget' => 45000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2',

        ]);

        Proposal::create([
            'collaboration_id' => 3,
            'influencer_id' => 3,
            'proposed_budget' => 14000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2, https://example.com/link3',

        ]);

        Proposal::create([
            'collaboration_id' => 4,
            'influencer_id' => 4,
            'proposed_budget' => 9000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2',

        ]);

        Proposal::create([
            'collaboration_id' => 5,
            'influencer_id' => 5,
            'proposed_budget' => 45000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2, https://example.com/link3',

        ]);

        Proposal::create([
            'collaboration_id' => 1,
            'influencer_id' => 6,
            'proposed_budget' => 14000,
            'supporting_links' => 'https://example.com/link1, https://example.com/link2',

        ]);
    }
}
