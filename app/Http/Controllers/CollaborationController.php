<?php

namespace App\Http\Controllers;

use App\Enums\CollaborationStatus;
use App\Models\Collaboration;
use App\Models\CollaborationTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaborationController extends Controller
{
    public function index()
    {
        // Get all the collaborations
        $collaborations = Collaboration::all();
        $users = User::all();
        return view('dashboard.collaborations.index', compact('collaborations', 'users'));
    }

    public function getByBusiness()
    {
        $businessId = Auth::id();
        $collaborations = Collaboration::where('business_id', $businessId)->get();
        return view('collaborations.my-collaborations', compact('collaborations'));
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

        if (auth()->user()->role_id->value == 1) {
            return redirect()->route('collaborations.index')->with('success', 'Collaboration created successfully');
        } else {
            return redirect()->route('collaborations.index', ['page' => 'my_collaborations'])->with('success', 'Collaboration created successfully');
        }
    }

    public function show(Collaboration $collaboration)
    {
        return $collaboration;
    }

    public function destroy(Collaboration $collaboration)
    {
        $collaboration->delete();

        return redirect()->route('collaborations.index')
            ->with('success', 'Collaboration deleted successfully');
    }
}
