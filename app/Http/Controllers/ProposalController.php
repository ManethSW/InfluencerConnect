<?php

namespace App\Http\Controllers;

use App\Enums\CollaborationStatus;
use App\Models\Collaboration;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index()
    {
        // Get all the collaborations
        $proposals = Proposal::all();
        $users = User::all();
        $collaborations = Collaboration::all();
        return view('dashboard.proposals.index', compact('proposals', 'users', 'collaborations'));
    }

    public function getByInfluencers()
    {
        $influencerId = Auth::id();
        $proposals = Proposal::where('influencer_id', $influencerId)->get();
        return view('collaborations.my-proposals', compact('proposals'));
    }

    public function acceptProposal(Proposal $proposal)
    {
        // Get the collaboration related to the proposal
        $collaboration = $proposal->collaboration;

        // Update the collaboration
        $collaboration->influencer_id = $proposal->influencer_id;
        $collaboration->budget = $proposal->proposed_budget;
        $collaboration->status = CollaborationStatus::Active->getValue();

        // Save the changes to the collaboration
        $collaboration->save();

        // Set the status of the accepted proposal to 'Accepted'
        $proposal->status = 1; // Assuming 1 is the status code for 'Accepted'
        $proposal->save();

        // Get all other proposals related to the collaboration
        $otherProposals = Proposal::where('collaboration_id', $collaboration->id)
            ->where('id', '!=', $proposal->id)
            ->get();

        // Set the status of all other proposals to 'Rejected'
        foreach ($otherProposals as $otherProposal) {
            $otherProposal->status = 2; // Assuming 2 is the status code for 'Rejected'
            $otherProposal->save();
        }

        return redirect()->route('collaborations.my_collaborations')->with('success', 'Proposal accepted successfully');
    }

    public function rejectProposal(Proposal $proposal)
    {
        // Update the proposal
        $proposal->status = 2; // Assuming 2 is the status code for 'Rejected'

        // Save the changes
        $proposal->save();

        return redirect()->route('collaborations.my_collaborations')->with('success', 'Proposal rejected successfully');
    }

    public function updateByInfluencers(Request $request, Proposal $proposal)
    {
        // Validate the request data
        $request->validate([
            'collaboration_id' => 'required|exists:collaborations,id',
            'proposed_budget' => 'required|numeric|min:0',
            'supporting_links' => 'nullable|string',
            'supporting_file_1' => 'nullable|file',
            'supporting_file_2' => 'nullable|file',
            'supporting_file_3' => 'nullable|file',
            'supporting_file_4' => 'nullable|file',
            'supporting_file_5' => 'nullable|file',
        ]);

        // Update the proposal
        $proposal->collaboration_id = $request->collaboration_id;
        // Get influencer id from the authenticated user
        $proposal->influencer_id = Auth::id();
        $proposal->proposed_budget = $request->proposed_budget;
        $proposal->supporting_links = $request->supporting_links;

        // Handle the supporting files
        for ($i = 1; $i <= 5; $i++) {
            $fileKey = "supporting_file_$i";
            if ($request->hasFile($fileKey)) {
                // Delete the old file if it exists
                if ($proposal->$fileKey) {
                    Storage::delete($proposal->$fileKey);
                }

                // Store the new file
                $path = $request->file($fileKey)->store('supporting_files', 'public');
                $proposal->$fileKey = $path;
            }
        }

        $proposal->save();

        return redirect()->route('collaborations.my_proposals')->with('success', 'Proposal updated successfully');
    }

    public function store(Request $request, Collaboration $collaboration)
    {
        // Check if the collaboration is still pending
        if ($collaboration->status != 0) {
            return response()->json(['error' => 'This collaboration is not accepting proposals.'], 400);
        }

        $existingProposal = Proposal::where('collaboration_id', $request->collaboration_id)
            ->where('influencer_id', $request->influencer_id)
            ->first();

        if ($existingProposal) {
            return redirect()->route('proposals.index')->with('error', 'You have already submitted a proposal for this collaboration');
        }

        // Validate the request data
        $request->validate([
            'collaboration_id' => 'required|exists:collaborations,id',
            'proposed_budget' => 'required|numeric|min:0',
            'supporting_links' => 'nullable|string',
            'supporting_file_1' => 'nullable|file',
            'supporting_file_2' => 'nullable|file',
            'supporting_file_3' => 'nullable|file',
            'supporting_file_4' => 'nullable|file',
            'supporting_file_5' => 'nullable|file',
        ]);

        // Create the proposal
        $proposal = new Proposal;
        $proposal->collaboration_id = $request->collaboration_id;
        $proposal->influencer_id = $request->influencer_id;
        $proposal->proposed_budget = $request->proposed_budget;
        $proposal->supporting_links = $request->supporting_links;

        // Handle the supporting files
        for ($i = 1; $i <= 5; $i++) {
            $fileKey = "supporting_file_$i";
            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('supporting_files', 'public');
                $proposal->$fileKey = $path;
            }
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal submitted successfully');
    }

    public function show($id)
    {
        $proposal = Proposal::with('influencer')->find($id);

        return response()->json($proposal);
    }

    public function update(Request $request, Proposal $proposal)
    {
        // Validate the request data
        $request->validate([
            'collaboration_id' => 'required|exists:collaborations,id',
            'proposed_budget' => 'required|numeric|min:0',
            'supporting_links' => 'nullable|string',
            'supporting_file_1' => 'nullable|file',
            'supporting_file_2' => 'nullable|file',
            'supporting_file_3' => 'nullable|file',
            'supporting_file_4' => 'nullable|file',
            'supporting_file_5' => 'nullable|file',
        ]);

        // Update the proposal
        $proposal->collaboration_id = $request->collaboration_id;
        $proposal->influencer_id = $request->influencer_id;
        $proposal->proposed_budget = $request->proposed_budget;
        $proposal->supporting_links = $request->supporting_links;

        // Handle the supporting files
        for ($i = 1; $i <= 5; $i++) {
            $fileKey = "supporting_file_$i";
            if ($request->hasFile($fileKey)) {
                // Delete the old file if it exists
                if ($proposal->$fileKey) {
                    Storage::delete($proposal->$fileKey);
                }

                // Store the new file
                $path = $request->file($fileKey)->store('supporting_files', 'public');
                $proposal->$fileKey = $path;
            }
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal updated successfully');
    }

    public function destroybyInfluencers(Proposal $proposal)
    {
        $proposal->delete();

        return redirect()->route('collaborations.my_proposals')->with('success', 'Proposal deleted successfully');
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Proposal deleted successfully');
    }
}
