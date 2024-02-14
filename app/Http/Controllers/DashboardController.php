<?php

namespace App\Http\Controllers;

use App\Enums\CollaborationStatus;
use App\Models\Collaboration;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('layouts.dashboard');
    }

    public function showDashboard()
    {
        $totalUsers = User::count();
        $totalInfluencers = User::where('role_id', '10')->count();
        $totalBusinesses = User::where('role_id', '11')->count();

        $totalCollaborations = Collaboration::count();
        $totalPendingCollaborations = Collaboration::where('status', CollaborationStatus::Pending)->count();
        $totalActiveCollaborations = Collaboration::where('status', CollaborationStatus::Active)->count();
        $totalCompletedCollaborations = Collaboration::where('status', CollaborationStatus::Completed)->count();

        $totalProposals = Proposal::count();
        $totalPendingProposals = Proposal::where('status', 0)->count();
        $totalAcceptedProposals = Proposal::where('status', 1)->count();
        $totalRejectedProposals = Proposal::where('status', 2)->count();

        $userGrowthByMonth = $this->getUserGrowthByMonth();

        return view('layouts.dashboard', compact(
            'totalUsers',
            'totalInfluencers',
            'totalBusinesses',
            'totalCollaborations',
            'totalPendingCollaborations',
            'totalActiveCollaborations',
            'totalCompletedCollaborations',
            'totalProposals',
            'totalPendingProposals',
            'totalAcceptedProposals',
            'totalRejectedProposals',
            'userGrowthByMonth'
        ));
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
