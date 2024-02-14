<?php

namespace App\Providers;

use App\Enums\CollaborationStatus;
use App\Models\Collaboration;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('layouts.dashboard', function ($view) {
            $totalUsers = User::count();
            $totalInfluencers = User::where('role_id', 10)->count();
            $totalBusinesses = User::where('role_id', 11)->count();

            $totalCollaborations = Collaboration::count();
            $totalPendingCollaborations = Collaboration::where('status', CollaborationStatus::Pending)->count();
            $totalActiveCollaborations = Collaboration::where('status', CollaborationStatus::Active)->count();
            $totalCompletedCollaborations = Collaboration::where('status', CollaborationStatus::Completed)->count();

            $totalProposals = Proposal::count();
            $totalPendingProposals = Proposal::where('status', 0)->count();
            $totalAcceptedProposals = Proposal::where('status', 1)->count();
            $totalRejectedProposals = Proposal::where('status', 2)->count();

            $userGrowthByMonth = $this->getUserGrowthByMonth();

            $view->with('totalUsers', $totalUsers);
            $view->with('totalInfluencers', $totalInfluencers);
            $view->with('totalBusinesses', $totalBusinesses);

            $view->with('totalCollaborations', $totalCollaborations);
            $view->with('totalPendingCollaborations', $totalPendingCollaborations);
            $view->with('totalActiveCollaborations', $totalActiveCollaborations);
            $view->with('totalCompletedCollaborations', $totalCompletedCollaborations);

            $view->with('totalProposals', $totalProposals);
            $view->with('totalPendingProposals', $totalPendingProposals);
            $view->with('totalAcceptedProposals', $totalAcceptedProposals);
            $view->with('totalRejectedProposals', $totalRejectedProposals);

            $view->with('userGrowthByMonth', $userGrowthByMonth);
        });
    }

    public function getUserGrowthByMonth()
    {
        $userCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $userCount = User::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->count();
            $userCounts[] = $userCount;
        }
        return $userCounts;
    }
}
