<?php

namespace App\Http\Controllers;

use App\Enums\CollaborationStatus;
use App\Models\Collaboration;
use App\Models\CollaborationTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CollaborationController extends Controller
{
    public function index()
    {
        $collaborations = Collaboration::all();
        $users = User::all();
        return view('dashboard.collaborations.index', compact('collaborations', 'users'));
    }

    public function getAllPending() {
        $pendingCollaborations = Collaboration::where('status', CollaborationStatus::Pending)->get();
        return view('search-collaborations', compact('pendingCollaborations'));
    }

    public function getByBusiness()
    {
        $businessId = Auth::id();
        $collaborations = Collaboration::where('business_id', $businessId)->get();
        return view('collaborations.my-collaborations', compact('collaborations'));
    }

    public function getByInfluencer() {
        $influencerId = Auth::id();
        $activeCollaborations = Collaboration::where('influencer_id', $influencerId)->get();
        return view('collaborations.active-influencer', compact('activeCollaborations'));
    }

    public function getActiveCollaborations()
    {
        $userId = Auth::id();

        if (auth()->user()->role_id->value == 10) {
            $activeCollaborations = Collaboration::where('influencer_id', $userId)
                ->where('status', CollaborationStatus::Active->getValue())
                ->get();
        } else {
            $activeCollaborations = Collaboration::where('business_id', $userId)
                ->where('status', CollaborationStatus::Active->getValue())
                ->get();
        }

        // Check if the user is an influencer or an business
        if (auth()->user()->role_id->value == 10) {
            return view('collaborations.active-influencer', compact('activeCollaborations'));
        } else {
            return view('collaborations.active-business', compact('activeCollaborations'));
        }
    }

    public function updateByBusiness(Request $request, Collaboration $collaboration)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'collaboration_type' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'deadline' => 'required',
            'tasks' => 'required|array|min:1',
            'tasks.*.description' => 'required',
            'tasks.*.priority' => 'required',
        ]);

        // Update the collaboration
        $collaboration->title = $request->title;
        $collaboration->collaboration_type = $request->collaboration_type;
        $collaboration->description = $request->description;
        $collaboration->budget = $request->budget;
        $collaboration->deadline = $request->deadline;
        $collaboration->save();

        // Update the tasks
        foreach ($request->tasks as $taskId => $taskData) {
            $task = CollaborationTask::find($taskId);
            if ($task) {
                $task->description = $taskData['description'];
                $task->priority = $taskData['priority'];
                $task->save();
            }
        }

        return redirect()->route('collaborations.my_collaborations')
            ->with('success', 'Collaboration updated successfully');
    }

    public function update(Request $request, Collaboration $collaboration)
    {
        $request->validate([
            'title' => 'required',
            'collaboration_type' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'deadline' => 'required',
            'tasks' => 'required|array|min:1',
            'tasks.*.description' => 'required',
            'tasks.*.priority' => 'required',
        ]);

        // Update the collaboration
        $collaboration->title = $request->title;
        $collaboration->collaboration_type = $request->collaboration_type;
        $collaboration->description = $request->description;
        $collaboration->budget = $request->budget;
        $collaboration->deadline = $request->deadline;
        $collaboration->save();

        // Update the tasks
        foreach ($request->tasks as $taskId => $taskData) {
            $task = CollaborationTask::find($taskId);
            if ($task) {
                $task->description = $taskData['description'];
                $task->priority = $taskData['priority'];
                $task->save();
            }
        }

        return redirect()->route('collaborations.index')->with('success', 'Collaboration updated successfully');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'business_id' => 'sometimes|exists:users,id',
            'title' => 'required',
            'collaboration_type' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'deadline' => 'required',
            'tasks' => 'required|array|min:1',
            'tasks.*.description' => 'required',
            'tasks.*.priority' => 'required',
        ]);

        $collaboration = new Collaboration;
        $collaboration->business_id = $request->input('business_id', auth()->id());
        $collaboration->title = $request->title;
        $collaboration->collaboration_type = $request->collaboration_type;
        $collaboration->description = $request->description;
        $collaboration->budget = $request->budget;
        $collaboration->deadline = $request->deadline;
        $collaboration->request_type = $request->request_type;
        $collaboration->status = CollaborationStatus::Pending;
        $collaboration->save();

        foreach ($request->tasks as $task) {
            $collaborationTask = new CollaborationTask;
            $collaborationTask->collaboration_id = $collaboration->id;
            $collaborationTask->description = $task['description'];
            $collaborationTask->priority = $task['priority'];
            $collaborationTask->save();
        }

        return redirect()->route('collaborations.index')->with('success', 'Collaboration created successfully');
    }

    public function storeByBusiness (Request $request)
    {
        $request->validate([
            'title' => 'required',
            'collaboration_type' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'deadline' => 'required',
            'tasks' => 'required|array|min:1',
            'tasks.*.description' => 'required',
            'tasks.*.priority' => 'required',
        ]);

        $collaboration = new Collaboration;
        $collaboration->business_id = Auth::id();
        $collaboration->title = $request->title;
        $collaboration->collaboration_type = $request->collaboration_type;
        $collaboration->description = $request->description;
        $collaboration->budget = $request->budget;
        $collaboration->deadline = $request->deadline;
        $collaboration->request_type = $request->request_type;
        $collaboration->status = CollaborationStatus::Pending;
        $collaboration->save();

        foreach ($request->tasks as $task) {
            $collaborationTask = new CollaborationTask;
            $collaborationTask->collaboration_id = $collaboration->id;
            $collaborationTask->description = $task['description'];
            $collaborationTask->priority = $task['priority'];
            $collaborationTask->save();
        }

        return redirect()->route('collaborations.my_collaborations')->with('success', 'Collaboration created successfully');
    }

    public function show(Collaboration $collaboration)
    {
        return $collaboration;
    }

    public function submitTask(Request $request)
    {
        try {
            $taskId = $request->input('task_id');

            // Validate the request data
            $request->validate([
                'task_id' => 'required|exists:collaboration_tasks,id',
                'supporting_links' => 'nullable|string',
                'supporting_file_1' => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,pdf,txt|max:2048',
                'supporting_file_2' => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,pdf,txt|max:2048',
                'supporting_file_3' => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,pdf,txt|max:2048',
                'supporting_file_4' => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,pdf,txt|max:2048',
                'supporting_file_5' => 'nullable|file|mimes:jpg,jpeg,png,doc,docx,pdf,txt|max:2048',
            ]);

            $task = CollaborationTask::find($taskId);

            if (!$task) {
                return redirect()->back()->with('error', 'Task not found');
            }

            for ($i = 1; $i <= 5; $i++) {
                $fileKey = "supporting_file_$i";
                if ($request->hasFile($fileKey)) {
                    $path = $request->file($fileKey)->store('supporting_files', 'public');
                    $task->$fileKey = $path;
                }
            }

            $task->save();

            if ($request->has('supporting_links')) {
                $task->supporting_links = $request->supporting_links;
            }

            for ($i = 1; $i <= 5; $i++) {
                $fileKey = "supporting_file_$i";
                if ($request->hasFile($fileKey)) {
                    $path = $request->file($fileKey)->store('public/supporting_files');
                    $path = str_replace('public/', '', $path);
                    $task->$fileKey = $path;
                }
            }

            $task->status = 1;
            $task->save();

            return redirect()->route('collaborations.active_influencer')->with('success', 'Task submitted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function completeTask(Request $request)
    {
        // Find the task
        $task = CollaborationTask::find($request->task_id);

        // Check if the task exists
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        // Set the task status to 2 (Completed)
        $task->status = 2;

        // Save the changes
        $task->save();

        // Find the collaboration that the task belongs to
        $collaboration = $task->collaboration;

        // Get all tasks of the collaboration
        $tasks = $collaboration->tasks;

        // Check if all tasks are completed
        $allTasksCompleted = $tasks->every(function ($task) {
            return $task->status == 2; // 2 represents 'Completed'
        });

        // If all tasks are completed, set the collaboration status to 'Completed'
        if ($allTasksCompleted) {
            $collaboration->status = CollaborationStatus::Completed->getValue();
            $collaboration->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Task completed successfully');
    }

    public function destroy(Collaboration $collaboration)
    {
        $collaboration->tasks()->delete();
        $collaboration->proposals()->delete();
        $collaboration->delete();

        return redirect()->route('collaborations.index')
            ->with('success', 'Collaboration deleted successfully');
    }

    public function destroyByBusiness(Collaboration $collaboration)
    {
        $collaboration->tasks()->delete();
        $collaboration->proposals()->delete();
        $collaboration->delete();
        return redirect()->route('collaborations.my_collaborations')
            ->with('success', 'Collaboration deleted successfully');
    }
}
