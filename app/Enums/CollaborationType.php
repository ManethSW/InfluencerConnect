<?php

namespace App\Enums;

enum CollaborationType: int
{
    // Backend roles
    const SponsoredContent = 1;
    const BrandAmbassador = 2;
    const AffiliateMarketing = 3;
    const ProductReview = 4;
    const Giveaway = 5;
    const AdCampaign = 6;
    const GuestPosting = 7;
    const EventAppearance = 8;

    public static function asSelectArray() {
        return [
            self::SponsoredContent => 'Sponsored Content',
            self::BrandAmbassador => 'Brand Ambassador',
            self::AffiliateMarketing => 'Affiliate Marketing',
            self::ProductReview => 'Product Review',
            self::Giveaway => 'Giveaway',
            self::AdCampaign => 'Ad Campaign',
            self::GuestPosting => 'Guest Posting',
            self::EventAppearance => 'Event Appearance',
        ];
    }
}
