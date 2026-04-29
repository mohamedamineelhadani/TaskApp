<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = $project->tasks()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => 'pending',
        ]);

        return response()->json([
            'message' => 'Task added successfully!',
            'task'    => $task,
        ], 201);
    }

    public function toggleStatus(Tasks $task)
    {
        $this->authorizeTask($task);

        $task->update([
            'status' => $task->isCompleted() ? 'pending' : 'completed',
        ]);

        return response()->json([
            'message' => 'Task status updated!',
            'task'    => $task,
        ]);
    }

    public function completeAll(Projects $project)
    {
        $this->authorizeProject($project);

        $project->tasks()->update(['status' => 'completed']);

        return response()->json([
            'message' => 'All tasks marked as completed!',
        ]);
    }


    public function destroy(Tasks $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully!',
        ]);
    }


    private function authorizeProject(Projects $project)
    {
        if ($project->id_user !== Auth::id()) {
            abort(response()->json([
                'message' => 'Unauthorized action.',
            ], 403));
        }
    }

    private function authorizeTask(Tasks $task)
    {
        if ($task->project->id_user !== Auth::id()) {
            abort(response()->json([
                'message' => 'Unauthorized action.',
            ], 403));
        }
    }
}