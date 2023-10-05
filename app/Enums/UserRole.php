<?php

namespace App\Enums;

enum UserRole: int
{
    // Backend roles
    case SuperAdministrator = 1;
    case Administrator = 2;
    case ContentModerator = 3;
    case BusinessManager = 4;
    case MarketingManager = 5;
    case InfluencerManager = 6;
    case AnalyticsManager = 7;
    case AdvertisementManager = 8;
    case SupportManager = 9;

    // Front end roles
    case Influencer = 10;
    case business = 11;
}
