<?php

namespace Database\Seeders;

use App\Enums\CollaborationStatus;
use App\Enums\CollaborationType;
use App\Models\Collaboration;
use App\Models\CollaborationTask;
use Illuminate\Database\Seeder;

class CollaborationSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 collaborations for each business
        Collaboration::create([
            'business_id' => 7,
            'title' => "Sponsored Content for XYZ Corp",
            'collaboration_type' => CollaborationType::SponsoredContent,
            'description' => "n this collaboration, the influencer will create and share content promoting XYZ Corp's products. This could be a blog post, a social media post, or a video.",
            'budget' => 15000,
            'deadline' => "2023-05-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 1,
            'description' => "Create a blog post promoting XYZ Corp's products",
            'priority' => 2,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 1,
            'description' => "Share the blog post on social media",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 1,
            'description' => "Create a video promoting XYZ Corp's products",
            'priority' => 3,
        ]);

        Collaboration::create([
            'business_id' => 7,
            'title' => "Product Review for ABC Inc",
            'collaboration_type' => CollaborationType::ProductReview,
            'description' => "In this collaboration, the influencer will review ABC Inc's products and share their thoughts with their audience.",
            'budget' => 10000,
            'deadline' => "2023-06-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 2,
            'description' => "Review ABC Inc's products",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 2,
            'description' => "Share the review on social media",
            'priority' => 2,
        ]);

        Collaboration::create([
            'business_id' => 8,
            'title' => "Brand Ambassador for 123 Co",
            'collaboration_type' => CollaborationType::BrandAmbassador,
            'description' => "In this collaboration, the influencer will become a brand ambassador for 123 Co, promoting their products and services over an extended period of time.",
            'budget' => 50000,
            'deadline' => "2023-07-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 3,
            'description' => "Promote 123 Co's products and services on social media",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 3,
            'description' => "Create and share content promoting 123 Co's products",
            'priority' => 2,
        ]);

        Collaboration::create([
            'business_id' => 8,
            'title' => "Product Review for ABC Inc",
            'collaboration_type' => CollaborationType::ProductReview,
            'description' => "In this collaboration, the influencer will review ABC Inc's products and share their thoughts with their audience.",
            'budget' => 10000,
            'deadline' => "2023-06-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 4,
            'description' => "Review ABC Inc's products",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 4,
            'description' => "Share the review on social media",
            'priority' => 2,
        ]);

        Collaboration::create([
            'business_id' => 9,
            'title' => "Brand Ambassador for 123 Co",
            'collaboration_type' => CollaborationType::BrandAmbassador,
            'description' => "In this collaboration, the influencer will become a brand ambassador for 123 Co, promoting their products and services over an extended period of time.",
            'budget' => 50000,
            'deadline' => "2023-07-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 5,
            'description' => "Promote 123 Co's products and services on social media",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 5,
            'description' => "Create and share content promoting 123 Co's products",
            'priority' => 2,
        ]);

        Collaboration::create([
            'business_id' => 10,
            'title' => "Sponsored Content for XYZ Corp",
            'collaboration_type' => CollaborationType::SponsoredContent,
            'description' => "In this collaboration, the influencer will create and share content promoting XYZ Corp's products. This could be a blog post, a social media post, or a video.",
            'budget' => 15000,
            'deadline' => "2023-05-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 6,
            'description' => "Create a blog post promoting XYZ Corp's products",
            'priority' => 2,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 6,
            'description' => "Share the blog post on social media",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 6,
            'description' => "Create a video promoting XYZ Corp's products",
            'priority' => 3,
        ]);

        Collaboration::create([
            'business_id' => 10,
            'title' => "Product Review for ABC Inc",
            'collaboration_type' => CollaborationType::ProductReview,
            'description' => "In this collaboration, the influencer will review ABC Inc's products and share their thoughts with their audience.",
            'budget' => 10000,
            'deadline' => "2023-06-01",
            'request_type' => 0,
            'status' => CollaborationStatus::Pending,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 7,
            'description' => "Review ABC Inc's products",
            'priority' => 1,
        ]);

        CollaborationTask::create([
            'collaboration_id' => 7,
            'description' => "Share the review on social media",
            'priority' => 2,
        ]);
    }
}
